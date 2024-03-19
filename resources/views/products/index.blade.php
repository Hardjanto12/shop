<!-- resources/views/products/index.blade.php -->

@extends('layouts.app') <!-- You can adjust the layout based on your application structure -->

@section('title', 'Products')

@section('content')
    <div class="container">
        <p class="text-6xl my-4 text-second font-main">Product List</p>

        @if (count($products) > 0)
            <ul>
                @foreach ($products as $product)
                    <li class="list-none font-main">
                        <p class="text-main font-bold">{{ $product->item }} DM</p>
                        <p class="text-white">Description: {{ $product->description ?? 'N/A' }}<br>
                            Price: @currency($product->price)<br>
                            Category: {{ $product->category->name }}<br>
                        </p>
                    </li><br>
                @endforeach
            </ul>
        @else
            <p class="text-main text-center">No Products Available</p>
        @endif
    </div>
@endsection
