<!-- resources/views/products/index.blade.php -->
@extends('layouts.app') <!-- You can adjust the layout based on your application structure -->

@section('title', 'Order')

@section('content')
    <div class="container mt-8 grid place-items-center">
        <h2 class="mb-2 text-lg font-semibold text-gray-900 dark:text-white">Products :</h2>
        <ul class="max-w-md space-y-1 text-gray-500 list-disc list-inside dark:text-gray-400">
            {{-- @dd($jsonData) --}}
            @foreach ($jsonData as $item)
                <li>{{ $item['code'] }}, {{ $item['nama_produk'] }}, {{ $item['deskripsi'] }} , {{ $item['price'] }} </li>
            @endforeach
        </ul>
    </div>
@endsection
