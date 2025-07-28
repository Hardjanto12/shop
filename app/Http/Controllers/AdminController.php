<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard(){
        return view('admin.report');
    }

    public function report(Request $request)
    {
         // Get the current month
        $currentMonth = Carbon::now()->format('Y-m');

        // Get the requested month from the URL parameter, default to current month if not provided
        $month = $request->input('month', $currentMonth);

        $sales = Order::join('order_items', 'orders.order_serial_number', '=', 'order_items.order_serial_number')
                ->join('products', 'order_items.product_code', '=', 'products.product_serial_number')
                ->join('categories', 'products.category_code', '=', 'categories.code')
                ->select(
                    'orders.order_serial_number',
                    'orders.game_id',
                    'orders.server_num',
                    'products.item',
                    'products.product_serial_number',
                    'orders.gross_price',
                    'products.category_code',
                    'categories.name',
                    'order_items.product_code',
                    'orders.status',
                    'orders.created_at'
                )
                ->whereYear('orders.created_at', Carbon::parse($month)->year)
                ->whereMonth('orders.created_at', Carbon::parse($month)->month)->where('orders.status', '=', 'success')
                ->paginate(2);

        // Calculate summary data
        $totalSales = $sales->sum('gross_price');
        $totalQuantity = $sales->count(); // Assuming each order item is counted once

        return view('admin.report', [
            'sales' => $sales,
            'totalSales' => $totalSales,
            'totalQuantity' => $totalQuantity
        ]);
    }
    public function productList(Request $request){
        $categories = Category::all();
        $query = Product::query();

        if ($request->has('category') && $request->category != 'all') {
            // $categoryId = Category::where('code', $request->category)->get()->pluck('id')->first();
            $query->where('category_code', $request->category);
        }

        $products = $query->paginate(10)->appends($request->query());

        return view('admin.product', compact('products', 'categories'));
    }
    public function orderList(Request $request) {
        // Get filters from the request
        $categoryId = $request->input('category_id');
        $status = $request->input('status');
        $searchTerm = $request->input('search');

        // Base query
        $query = Order::join('order_items', 'orders.order_serial_number', '=', 'order_items.order_serial_number')
            ->join('products', 'order_items.product_code', '=', 'products.product_serial_number')
            ->join('categories', 'products.category_code', '=', 'categories.code')
            ->select(
                'orders.order_serial_number',
                'orders.game_id',
                'orders.server_num',
                'products.item',
                'products.product_serial_number',
                'orders.gross_price',
                'products.category_code',
                'categories.name',
                'order_items.product_code',
                'orders.status',
                'orders.created_at'
            );

            // dd($query);

        // Apply category filter
        if ($categoryId) {
            $query->where('categories.code', $categoryId);
        }

        // Apply status filter
        if ($status && $status == 'success') {
            $query->where('orders.status', 'success');
        }

        // Apply search filter
        if ($searchTerm) {
            $query->where(function ($q) use ($searchTerm) {
                $q->where('orders.order_serial_number', 'LIKE', "%$searchTerm%")
                  ->orWhere('orders.game_id', 'LIKE', "%$searchTerm%")
                  ->orWhere('orders.server_num', 'LIKE', "%$searchTerm%")
                  ->orWhere('products.item', 'LIKE', "%$searchTerm%")
                  ->orWhere('products.product_serial_number', 'LIKE', "%$searchTerm%")
                  ->orWhere('orders.gross_price', 'LIKE', "%$searchTerm%")
                  ->orWhere('categories.name', 'LIKE', "%$searchTerm%");
            });
        }

        // Paginate the results
        $orders = $query->paginate(10);

        // Categories for the filter dropdown
        $categories = Category::all();

        return view('admin.order', [
            'orders' => $orders,
            'categories' => $categories,
            'selectedCategory' => $categoryId,
            'selectedStatus' => $status,
            'searchTerm' => $searchTerm,
        ]);
    }


    public function categoryList(){
        $category = Category::paginate(10);
        return view('admin.category')->with('categories', $category);
    }
}