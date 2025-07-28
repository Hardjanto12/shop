<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::all()->sortBy('category_id');
        return view('products.index', compact('products'));
    }


    public function fetch()
    {
        // Fetch all order items from the database
        $products = Product::all();

        // Return the order items as a JSON response
        return response()->json($products);
    }

    public function show($serialnumber)
    {
        // Find the order item by its serialnumber
        $productItem = Product::where('product_serial_number', $serialnumber)->first();

        if (!$productItem) {
            // If order item not found, return error response
            return response()->json(['message' => 'Product Item not found'], 404);
        }

        // Return the order item as a JSON response
        return response()->json($productItem);
    }

    public function fetchAndUpdate(Request $request){

        $categoryId = $request->input('category_id');
        // $categoryCode = Category::where('id', $categoryId)->get()->pluck('code')->first();
        // Fetch data from the API
    $response = Http::get('https://api.tokovoucher.id/produk/code?member_code=M240317FBIE2346GZ&signature=f8a6768c402b84dbf3583e41ad3e9825&kode=' . $categoryId);

    if ($response->successful()) {
        // Decode JSON response into an array
        $data = $response->json();

        if (isset($data['status']) && $data['status'] == 1 && isset($data['data'])) {
            // echo 'success';
            foreach ($data['data'] as $item) {
                $product_serial_number = $item['code'];
                $product_name = $item['nama_produk'];
                $description = $item['deskripsi'] ?: $product_name;
                $price = $item['price'];
                $status = $item['status'];
                $category_code = $categoryId; // Fixed category ID
                $timestamp = Carbon::now()->toDateTimeString();

                // Check if the record exists
                $exists = DB::table('products')
                    ->where('product_serial_number', $product_serial_number)
                    ->exists();

                if ($exists) {
                    // Update existing record
                    $sql = "UPDATE products SET
                                item = '$product_name',
                                description = '$description',
                                price = $price,
                                category_code = '$category_code',
                                status = $status,
                                updated_at = '$timestamp'
                            WHERE product_serial_number = '$product_serial_number';";
                } else {
                    // Insert new record
                    $sql = "INSERT INTO products (product_serial_number, item, description, price, category_code, status, created_at, updated_at)
                            VALUES ('$product_serial_number', '$product_name', '$description', $price, '$category_code', $status, '$timestamp', '$timestamp');";
                }

                $queries[] = $sql;

            // Execute the SQL statement
            DB::statement($sql);
            }
            // Return the generated SQL statements for debugging purposes
            return response()->json([
                'status' => 'success',
                'queries' => $queries
            ]);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Invalid JSON data'
                ]);
            }
        }
    }

    public function addProduct()
    {
        $response = Http::get('https://api.tokovoucher.id/produk/code?member_code=M240317FBIE2346GZ&signature=f8a6768c402b84dbf3583e41ad3e9825&kode=MLA');

        if ($response->successful()) {
            $data = $response->json();
            $sortedData = collect($data['data'])->sortBy('id')->values()->all();
            // Process fetched data
            return view('orders.mobile-legends.fetch', ['jsonData' => $sortedData]);
            // return view('orders.mobile-legends.fetch')->with('data', $data);
        } else {
            // Handle error
            return response()->json(['error' => 'Failed to fetch data from API'], $response->status());
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
        ]);

        $product = Product::find($id);
        if (!$product) {
            return response()->json(['success' => false, 'message' => 'Product not found.'], 404);
        }

        $product->update([
            'item' => $request->name,
            'price' => $request->price,
        ]);

        return response()->json(['success' => true, 'product' => $product]);
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('productlist')->with('success', 'Product deleted successfully.');
    }


}