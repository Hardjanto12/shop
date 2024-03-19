<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

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
}