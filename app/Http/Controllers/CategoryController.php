<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all()->sortBy('name');
        return view('categories.index', compact('categories'));
    }

    public function show($slug)
    {
        $categoryId = Category::where('slug', $slug)->first();
        $products = Product::where('category_id', $categoryId->id)
        ->orderBy('item')
        ->get();

        return view('orders.mobile-legends.index')->with('product', $products);

        // return view('products.index', compact('products'));
    }
}