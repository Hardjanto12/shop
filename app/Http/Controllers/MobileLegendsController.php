<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class MobileLegendsController extends Controller
{
    public function index()
    {
        /* This code snippet is making an HTTP GET request to the specified URL
        It then retrieves the JSON response from the request and sorts the data based on
        the 'id' key in ascending order using Laravel Collection methods. Finally, it converts the
        sorted data back to an array. */
        $response = Http::get('https://api.tokovoucher.id/produk/code?member_code=M240317FBIE2346GZ&signature=f8a6768c402b84dbf3583e41ad3e9825&kode=MLA');

        $data = $response->json();
        $sortedData = collect($data['data'])->sortBy('id')->values()->all();

        $categoryId = Category::where('slug', 'mobile-legends')->first();
        $products = Product::where('category_id', $categoryId->id)
        ->orderBy('item')
        ->get();

        return view('orders.mobile-legends.index')->with(['product' => $products, 'jsonData' => $sortedData]);

        // return view('products.index', compact('products'));
    }

    public function fetch(){
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

    public function placeOrder(Request $request)
    {
         // Validate request data
    $request->validate([
        'game_id' => 'required',
        'server_num' => 'required',
        'email' => 'required',
        'item' => 'required',
        // Add more validation rules as needed
    ]);

    // Retrieve input data from the request
    $game_id = $request->input('game_id');
    $server_num = $request->input('server_num');
    $email = $request->input('email');
    $item = $request->input('item');

    /* This line of code is querying the `Product` model to retrieve the `id` of a product based on the
    provided `product_serial_number`.*/
    $product_id = Product::where('product_serial_number', $item)->get()->pluck('id')->first();
    $game = 'ML';

    // Start a database transaction
    DB::beginTransaction();

    try {
        // Create a new order
        // Order Header
        $order = new Order();

        $usercount = DB::table('orders')->count() + 1;

        /* The code block you provided is determining the user ID based on whether the user is authenticated or
        not. Here's a breakdown of what it does: */
        if (Auth::check() == false) {
            $user_id = "GUEST/" . sprintf ("%04d", $usercount) . '/' . $game_id ;
        }
        else{
            $user_id = "USER/" . sprintf ("%04d", (Auth::user()->id)) . '/' . $game_id;
        }

        $generate_serial_number = $game . date("dmy") . sprintf ("%04d", $usercount);
        /*  generating a unique order serial number for the order being created. */
        $order->order_serial_number = $generate_serial_number;

        $order->customer_serial_number = $user_id;
        $order->game_id = $game_id;
        $order->server_num = $server_num;
        $order->email = $email;

        $order->save();

        // Order Detail
        $orderItem = new OrderItem();

        /* The line is generating a unique order item serial number for the order item being created. */
        $orderItem->order_item_serial_number = $game . '/' . sprintf ("%04d", $usercount) . '/' . $game_id  ;
        $orderItem->order_serial_number = $generate_serial_number;
        $orderItem->product_id = $product_id;

        $orderItem->save();

        // Commit the transaction
        DB::commit();
        // return $orderid;
        return redirect()->route('payment.order.ml')->with(['success'=> 'Your order has been placed successfully! Pay before 24 hours!', 'orderid'=> $generate_serial_number]);
        } catch (\Exception $e) {
            // Rollback the transaction if an exception occurs
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to place your order. Please try again later.');
        }
    }

    public function payment(){
        return view('payment.index');
    }

    public function executeOrder(Request $request){

        $refId = $request->input('refId');
        $produk_id = OrderItem::where('order_serial_number', $refId)->get()->pluck('product_id')->first();
        $produkCode = Product::where('id', $produk_id)->get()->pluck('product_serial_number')->first();
        $tujuan = Order::where('order_serial_number', $refId)->get()->pluck('game_id')->first();
        $server_id = Order::where('order_serial_number', $refId)->get()->pluck('server_id')->first();

        $memberCode = 'M240317FBIE2346GZ';
        $secretCode = 'b135661cf54f7cf31bf9a3ebe156f6f3d34a9b88d5c2610eb2c31b2de93090fd';
        $signature =  $memberCode . ':' . $secretCode . ':' . $refId;

        $response = Http::post('https://api.tokovoucher.id/v1/transaksi', [
            'ref_id' => $refId,
            'produk' => $produkCode,
            'tujuan' => $tujuan,
            'server_id' => $server_id,
            'member_code' => 'M240317FBIE2346GZ',
            'signature' => md5($signature)
        ]);

        // Check if the request was successful
        if ($response->successful()) {
            // Process the response
            $responseData = $response->json();
            dd($responseData);
        } else {
            // Handle the error
            $statusCode = $response->status();
            $errorMessage = $response->body();
        }

        return "payment success";
    }
}