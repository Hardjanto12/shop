<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $product = Product::all()->sortBy('category_id');

        return view('orders.index')->with('product', $product);
    }

    public function fetch()
    {
        // Fetch all order items from the database
        $orders = Order::all();

        // Return the order items as a JSON response
        return response()->json($orders);
    }

    public function show($id)
    {
        // Find the order item by its ID
        $orderItem = Order::find($id);

        if (!$orderItem) {
            // If order item not found, return error response
            return response()->json(['message' => 'Order Item not found'], 404);
        }

        // Return the order item as a JSON response
        return response()->json($orderItem);
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
    $product_id = Product::where('product_serial_number', $item)->get()->pluck('id')->first();

    /* The line `list(, ) = explode('-', );` is splitting the string stored in the
    variable `` into two parts based on the delimiter `-`. */
    // list($game, $number) = explode('-', $item);
    $game = 'ML';

    // Start a database transaction
    DB::beginTransaction();

    try {
        // Create a new order
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

        $orderItem = new OrderItem();

        /* The line is generating a unique order item serial number for the order item being created. */
        $orderItem->order_item_serial_number = $game . '/' . sprintf ("%04d", $usercount) . '/' . $game_id  ;
        $orderItem->order_serial_number = $generate_serial_number;
        $orderItem->product_id = $product_id;

        $orderItem->save();

        // Commit the transaction
        DB::commit();
        // return $orderid;
        return redirect()->route('payment.order')->with(['success'=> 'Your order has been placed successfully! Pay before 24 hours!', 'orderid'=> $generate_serial_number]);
        } catch (\Exception $e) {
            // Rollback the transaction if an exception occurs
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to place your order. Please try again later.');
        }
    }

    public function payment(){
        return view('payment.index');
    }
}