@extends('layouts.app')

@section('title', 'Payment Page')

@section('content')
    <div class="container">
        <p class="text-6xl text-second">Halaman Pembayaran</p>

        @if (session('success'))
            <div class="p-4 my-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                role="alert">
                <span class="font-medium">{{ session('success') }}<br>
            </div>
        @endif

        {{-- <p>{{ $orderid }}</p> --}}
        <p class="text-white">
            {{ session('orderid') }}
        </p>


    </div>
@endsection
