<!-- resources/views/products/index.blade.php -->

@extends('layouts.app') <!-- You can adjust the layout based on your application structure -->

@section('title', 'Cart')


@section('content')
    <div class="container">
        <p class="text-6xl my-4">Product List</p>

        @if (count($products) > 0)
            <ul>
                @foreach ($products as $product)
                    <li>
                        <strong>{{ $product->name }}</strong><br>
                        Description: {{ $product->description ?? 'N/A' }}<br>
                        Price: ${{ $product->price }}<br><br>
                        <!-- Add more details if needed -->
                    </li>
                @endforeach
            </ul>
        @else
            <p class="text-center">No Products Available</p>
        @endif
    </div>
@endsection
