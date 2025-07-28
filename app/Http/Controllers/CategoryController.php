<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


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


    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return response()->json($category);
    }

   public function store(Request $request)
   {
    $request->validate([
        'name' => 'required|string|max:255',
        'code' => 'required|string|max:255'
    ]);

    $slug = Str::slug($request->name, '-');

    $category = Category::create([
        'name' => $request->name,
        'slug' => $slug,
        'code' => $request->code
    ]);

    return response()->json(['success' => true]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:255',
        ]);

        $category = Category::findOrFail($id);
        $category->update($request->all());

        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('categorylist')->with('success', 'Category deleted successfully.');
    }

}