<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
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
}