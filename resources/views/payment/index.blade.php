@extends('layouts.app')

@section('title', 'Payment Page')

@section('content')
    <div class="container">
        <p class="text-6xl text-second">Halaman Pembayaran</p>

        @if (session('success'))
            <div class="p-4 my-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                role="alert">
                <span class="font-medium">{{ session('success') }}</span><br>
            </div>
        @endif

        <div class="p-4 my-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
            role="alert">
            <span class="font-medium">Ref ID : {{ session('orderid') }}</span><br>
        </div>

        <button id="pay-button"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            Bayar sekarang
            <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                fill="none" viewBox="0 0 14 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M1 5h12m0 0L9 1m4 4L9 9" />
            </svg>
        </button>
        {{-- <p>{{ session('snap_token') }}</p> --}}
    </div>
@endsection

@section('scripts')
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
    <script type="text/javascript">
        document.getElementById('pay-button').onclick = function() {
            // SnapToken acquired from previous step
            snap.pay('{{ session('snap_token') }}', {
                // Optional
                onSuccess: function(result) {
                    /* Setelah berhasil, lakukan pengiriman order_id melalui POST ke route 'mobile-legends/checkout' */

                    // Dapatkan nilai refId dari hasil transaksi
                    var refId = result.order_id;

                    // Tentukan data yang akan dikirim dalam body request
                    var data = {
                        refId: refId
                    };

                    // Tentukan URL dari route
                    var url = "{{ route('execute.order.ml') }}";

                    // Tentukan opsi untuk request fetch
                    var options = {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}' // Sertakan CSRF token jika aplikasi Anda menggunakan proteksi CSRF
                        },
                        body: JSON.stringify(data)
                    };

                    // Kirim request POST
                    fetch(url, options)
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Respon jaringan tidak ok');
                            }
                            return response.json();
                        })
                        .then(data => {
                            // Handle respons sukses
                            // Tambahkan refId ke URL sebagai query parameter
                            window.location.href =
                                "{{ route('transaction.success') }}" + "?refId=" +
                                refId; // Redirect ke halaman sukses setelah berhasil dengan refId
                        })
                        .catch(error => {
                            // Handle error
                            console.error('Ada masalah dengan operasi fetch:', error);
                        });
                },
                // Optional
                onPending: function(result) {
                    /* You may add your own js here, this is just example */
                    document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                },
                // Optional
                onError: function(result) {
                    /* You may add your own js here, this is just example */
                    document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                }
            });
        };
    </script>
@endsection
