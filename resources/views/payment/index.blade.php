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
        <div class="p-4 my-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
            role="alert">
            <span class="font-medium">Ref ID : {{ session('orderid') }}<br>
        </div>

        <form action="{{ route('execute.order.ml') }}" method="post">
            @csrf
            <input type="hidden" id="refId" name="refId" value="{{ session('orderid') }}" class=""
                placeholder="" />

            <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Bayar sekarang
                <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M1 5h12m0 0L9 1m4 4L9 9" />
                </svg>
            </button>
        </form>

    </div>
@endsection
