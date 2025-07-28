<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class ValorantController extends Controller
{
    public function index()
    {
        $categoryId = Category::where('slug', 'valorant')->first();
        $products = Product::where('category_code', $categoryId->code)->where('status', true)
            ->orderBy('price')
            ->get();

        return view('orders.valorant.index')->with(['product' => $products]);
    }

    public function fetch()
    {
        $response = Http::get('https://api.tokovoucher.id/produk/code?member_code=M240317FBIE2346GZ&signature=f8a6768c402b84dbf3583e41ad3e9825&kode=VALO');

        if ($response->successful()) {
            $data = $response->json();
            $sortedData = collect($data['data'])->sortBy('id')->values()->all();
            // Process fetched data
            return view('orders.valorant.fetch', ['jsonData' => $sortedData]);
            // return view('orders.valorant.fetch')->with('data', $data);
        } else {
            // Handle error
            return response()->json(['error' => 'Failed to fetch data from API'], $response->status());
        }
    }

    public function placeOrder(Request $request)
    {

        // validate user id and server num
        // Validate request data
        $request->validate([
            'game_id' => 'required',
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
        $product_id = Product::where('product_serial_number', $item)->get()->pluck('product_serial_number')->first();
        $product_price = Product::where('product_serial_number', $item)->get()->pluck('price')->first();
        $game = 'VALO';
        // Start a database transaction
        DB::beginTransaction();
        try {
            // Create a new order
            // Order Header
            $order = new Order();
            $usercount = DB::table('orders')->count() + 1;

            /* The code block you provided is determining the user ID based on whether the user is authenticated or
            not. Here's a breakdown of what it does: */
            // if (Auth::check() == false) {
            //     $user_id = "GUEST/" . sprintf("%04d", $usercount) . '/' . $game_id;
            // } else {
            //     $user_id = "USER/" . sprintf("%04d", (Auth::user()->id)) . '/' . $game_id;
            // }
            $user_id = sprintf("%04d", $usercount) . '/' . $game_id;

            $generate_serial_number = $game . date("dmy") . sprintf("%04d", $usercount);
            /*  generating a unique order serial number for the order being created. */
            $order->order_serial_number = $generate_serial_number;

            $order->customer_serial_number = $user_id;
            $order->game_id = $game_id;
            $order->server_num = $server_num;
            $order->email = $email;
            $order->gross_price = $product_price;


            // Set your Merchant Server Key
            \Midtrans\Config::$serverKey = config('midtrans.serverKey');
            // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
            \Midtrans\Config::$isProduction = config('midtrans.isProduction');
            // Set sanitization on (default)
            \Midtrans\Config::$isSanitized = config('midtrans.isSanitized');
            // Set 3DS transaction for credit card to true
            \Midtrans\Config::$is3ds = config('midtrans.is3ds');

            $order->save();


            // Order Detail
            $orderItem = new OrderItem();

            /* The line is generating a unique order item serial number for the order item being created. */
            $orderItem->order_item_serial_number = $game . '/' . sprintf("%04d", $usercount) . '/' . $game_id;
            $orderItem->order_serial_number = $generate_serial_number;
            $orderItem->product_code = $product_id;

            $orderItem->save();
            /* This block of code is responsible for generating a unique Snap token for the payment transaction
            using the Midtrans payment gateway. Here's a breakdown of what it does: */



            $params = array(
                'transaction_details' => array(
                    'order_id' => $generate_serial_number,
                    'gross_amount' => $product_price,
                ),
            );

            $snapToken = \Midtrans\Snap::getSnapToken($params);


            $order->snap_token = $snapToken;
            $order->save();

            // Commit the transaction
            DB::commit();
            // return $orderid;
            return redirect()->route('payment.order.valo')->with(['success' => 'Your order has been placed successfully! Pay before 24 hours!', 'orderid' => $generate_serial_number, 'snap_token' => $snapToken]);
        } catch (\Exception $e) {
            // Rollback the transaction if an exception occurs
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to place your order. Please try again later.');
        }
    }

    public function payment()
    {
        return view('orders.valorant.payment');
    }

    public function executeOrder(Request $request)
    {

        $refId = $request->input('refId');
        $product_id = OrderItem::where('order_serial_number', $refId)->get()->pluck('product_code')->first();

        // $produkCode = Product::where('id', $produk_id)->get()->pluck('product_serial_number')->first();

        $tujuan = Order::where('order_serial_number', $refId)->get()->pluck('game_id')->first();
        $server_id = Order::where('order_serial_number', $refId)->get()->pluck('server_id')->first();

        $memberCode = 'M240317FBIE2346GZ';
        $secretCode = 'b135661cf54f7cf31bf9a3ebe156f6f3d34a9b88d5c2610eb2c31b2de93090fd';
        $signature =  $memberCode . ':' . $secretCode . ':' . $refId;

        $response = Http::post('https://api.tokovoucher.id/v1/transaksi', [
            'ref_id' => $refId,
            'produk' => $product_id,
            'tujuan' => $tujuan,
            'server_id' => $server_id,
            'member_code' => 'M240317FBIE2346GZ',
            'signature' => md5($signature)
        ]);

        // // Periksa apakah permintaan berhasil
        if ($response->successful()) {
            // Proses respons
            $responseData = $response->json();

            return $responseData;

            // return response()->json(['data' => $responseData]);
        } else {
            // Tangani kesalahan
            if ($response->failed()) {
                $errorMessage = "Terjadi masalah saat operasi pengambilan: Kesalahan: Respons jaringan tidak ok";
                return response()->json(['error' => $errorMessage], 400);
            }
            $statusCode = $response->status();
            $errorMessage = $response->body();
            return response()->json(['error' => "Kesalahan: " . $errorMessage . " dengan kode status " . $statusCode], $statusCode);
        }
    }

    public function success(Request $request)
    {
        $order = new Order();

        // $refId = $request->session()->get('refId', 'Tidak ada referensi ID');
        $refId = $request->input('refId');

        // Update status order dari "pending" menjadi "success"
        $order = Order::where('order_serial_number', $refId)->first();
        $produk_id = OrderItem::where('order_serial_number', $refId)->get()->pluck('product_code')->first();
        $grossPrice = Product::where('product_serial_number', $produk_id)->get()->pluck('price')->first();


        $order->status = 'success';
        $order->gross_price = $grossPrice;
        $order->save();


        return view('transaction-success.index')->with('refId', $refId);
    }
}
