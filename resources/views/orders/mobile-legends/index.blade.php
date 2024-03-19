<!-- resources/views/products/index.blade.php -->
@extends('layouts.app') <!-- You can adjust the layout based on your application structure -->

@section('title', 'Order')

@section('content')
    <div class="container mt-8 grid place-items-center">

        @if ($product->first()->category->name == null)
            <p class="text-6xl text-second mt-4 mb-12 text-center">No Products Available</p>
        @else
            <p class="text-second mt-4 text-6xl mb-12">{{ $product->first()->category->name . ' Order Form' ?? '' }}
            </p>
            {{-- cards --}}
            <div class="bg-theme-secondary-white rounded-2xl p-6 border border-gray-200 shadow max-w-xl max-h-xl">
                <form class="max-w-sm" action="{{ route('place.order') }}" method="post">
                    @csrf

                    <div class="grid md:grid-cols-2 md:gap-6">
                        <div class="relative z-0 w-full group">
                            <div class="mb-2">
                                <label for="game_id" class="block mb-2 text-sm font-medium text-light-theme">ID
                                    Game</label>
                                <input type="number" id="game_id" name="game_id" min="1"
                                    class="bg-gray-50 border border-gray-300 text-dark-theme text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="ID Game" required>
                            </div>
                        </div>
                        <div class="relative z-0 w-full group">
                            <div class="mb-2">
                                <label for="server_num" class="block mb-2 text-sm font-medium text-light-theme">
                                    Server Number
                                </label>
                                <input type="number" id="server_num" name="server_num" min="1"
                                    class="bg-gray-50 border border-gray-300 text-dark-theme text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500 no-spinner"
                                    placeholder="Server Number" required />
                            </div>
                        </div>
                    </div>

                    {{-- /* The code snippet you provided is creating an input field for the user's email address within a form.
            Let's break down the HTML elements and their purposes: */ --}}
                    <div class="mb-2">
                        <label for="email" class="block mb-2 text-sm font-medium text-light-theme">Email</label>
                        <input type="email" id="email" name="email"
                            class="bg-gray-50 border border-gray-300 text-dark-theme text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                            placeholder="name@mail.com" />
                    </div>

                    <div class="mb-4">
                        <label for="item" class="block mb-2 text-sm font-medium text-light-theme">Pilih Item</label>
                        <select id="item" name="item"
                            class="bg-gray-50 border border-gray-300 text-dark-theme text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required>
                            <option>
                                Pilih Item
                            </option>
                            {{-- @foreach ($product as $p)
                                <option value="{{ $p->product_serial_number }}">
                                    {{ $p->item }}
                                    DM - {{ $p->category->name }}
                                </option>
                            @endforeach --}}
                            {{-- <li>{{ $item['nama_produk'] }} - @currency($item['price'])</li> --}}
                            @foreach ($jsonData as $item)
                                <option value="{{ $item['code'] }}">
                                    {{ $item['nama_produk'] }} - @currency($item['price'])
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-2 grid place-items-center">
                        <button type="submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center me-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Buat
                            Pesanan
                            <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M1 5h12m0 0L9 1m4 4L9 9" />
                            </svg></button>
                    </div>
                </form>
            </div>
    </div>

    @endif
@endsection
