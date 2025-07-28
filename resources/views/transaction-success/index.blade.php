@extends('layouts.app')

@section('title', 'Transaksi Berhasil')

@section('content')
    <div class="container mt-8">
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Berhasil!</strong>
            <span class="block sm:inline">Transaksi Anda telah berhasil diproses.</span>
        </div>
        <p class="text-gray-300 mt-4">ID Referensi Transaksi Anda adalah: <strong>{{ request()->refId }}</strong></p>
        <div class="mt-4 text-gray-300">
            @php
                use App\Models\Order;
                $order = Order::where('order_serial_number', request()->refId)->first();
            @endphp
            <p>ID Game: <strong>{{ $order->game_id }}</strong></p>
            <p>Nomor Server: <strong>{{ $order->server_num }}</strong></p>
            <p>Status Transaksi: <strong>{{ strtoupper($order->status) }}</strong></p>
            <p>Total Pembayaran: <strong>@currency($order->gross_price)</strong></p>
        </div>


        <div class="mt-6">
            <a href="{{ route('home') }}" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-700">Kembali ke
                Beranda</a>
        </div>
    </div>
@endsection


@section('scripts')
@endsection
