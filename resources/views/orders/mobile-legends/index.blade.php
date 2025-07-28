<!-- resources/views/products/index.blade.php -->
@extends('layouts.app') <!-- You can adjust the layout based on your application structure -->

@section('title', 'Order')

@section('styles')
@endsection

@section('content')

    <div class="flex flex-row items-center justify-center">
        <div class="basis-1/3 mx-auto px-24 py-32">
            <h1 class="text-3xl mb-4 font-bold uppercase text-left text-white">Form Order <br> Mobile Legends
            </h1>
            <form class="max-w-lg" id="orderForm" action="{{ route('place.order.valo') }}" method="post">
                @csrf
                {{-- id form --}}
                <div class="grid md:grid-cols-2 md:gap-6 text-sm mb-2">
                    <div class="relative z-0">
                        <div class="mb-2">
                            <label for="game_id" class="relative z-0 w-full mb-2 text-white font-bold text-sm">ID
                                Game</label>
                            <input type="number" id="game_id" name="game_id" min="1"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="ID Game" required>
                        </div>
                    </div>
                    <div class="relative z-0">
                        <div class="mb-2">
                            <label for="server_num" class="relative z-0 w-full mb-2 text-left text-white font-bold text-sm">
                                Server Number
                            </label>
                            <input type="number" id="server_num" name="server_num" min="1"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 no-spinner"
                                placeholder="Server Number" required />
                        </div>
                    </div>
                </div>

                {{-- email form --}}
                <div class="mb-3">
                    <div class="relative z-0 w-full mb-2 text-left">
                        <label for="email" class="mb-2 text-sm font-bold text-white">Email</label>
                        <input type="text" id="email" name="email" min="1"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full"
                            placeholder="Masukkan email" required>
                    </div>
                </div>

                {{-- item select --}}
                <div class="mb-14">
                    <div class="relative z-0 w-full mb-2 text-left">
                        <label for="item" class="mb-2 text-sm font-bold text-white">Pilih Item</label>
                        <select id="item" name="item"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            required>
                            <option>
                                Pilih Item
                            </option>
                            @foreach ($product as $item)
                                <option value="{{ $item['product_serial_number'] }}">
                                    {{ $item['item'] }} - @currency($item['price'])
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- button --}}
                <div class="mb-2 place-items-center relative z-0 w-full text-left">
                    <button type="submit" id="submitBtn"
                        class="text-white bg-orange-600 hover:bg-orange-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full py-2.5 text-center inline-flex items-center justify-center">Buat
                        Pesanan
                        <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M1 5h12m0 0L9 1m4 4L9 9" />
                        </svg></button>
                </div>

            </form>
        </div>
        <div class="basis-2/3 mx-auto px-24 py-32 ">
            <img class="mx-auto drop-shadow-lg rounded-3xl h-full w-full" src="/img/cecil.jpg">
        </div>

    </div>


@endsection

@section('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Find the button element by its ID
            const submitBtn = document.getElementById('submitBtn');

            // Add an event listener to the button click
            submitBtn.addEventListener('click', function(event) {
                // Prevent the default form submission behavior
                event.preventDefault();

                // Disable the button to prevent double submission
                submitBtn.disabled = true;

                // Retrieve the values of game_id and server_num fields
                const gameId = document.getElementById('game_id').value;
                const serverNum = document.getElementById('server_num').value;

                // Make an API call to validate gameId and serverNum
                fetch('https://id-game-checker.p.rapidapi.com/mobile-legends/' + gameId + '/' + serverNum, {
                        method: 'GET',
                        headers: {
                            'x-rapidapi-key': 'ef103d30b7msh47e5161ac2924e4p1b77aejsn3362e7a20cb2',
                            'x-rapidapi-host': 'id-game-checker.p.rapidapi.com'
                        }
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        // Check the API response
                        if (data.success == true) {
                            // console.log(data);
                            // console.log('User Id:' + data.data.userId '/n Username: ' + data.data
                            //     .username);
                            // If the values are valid, submit the form
                            document.getElementById('orderForm').submit();
                        } else {
                            // If the values are not valid, show an alert
                            console.log(data);
                            alert(data.msg);
                        }
                    })
                    .catch(error => {
                        // Handle any errors that occurred during the API call
                        console.error('Error:', error);
                        alert('An error occurred. Please try again later.');
                    });
            });
        });
    </script>

@endsection
