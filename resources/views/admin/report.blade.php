@extends('admin.dashboard')


@section('content')
    <div class="bg-gray-800 p-4 rounded-lg">
        <h2 class="text-2xl font-bold mb-4">Sales Report</h2>

        <form action="{{ route('sales.report') }}" method="GET" class="mb-4 flex items-center justify-between">
            <div class="flex items-center">
                <label for="month" class="text-white mr-2">Select Month:</label>
                <input type="month" id="month" name="month" class="bg-gray-700 text-white rounded p-2"
                    value="{{ request('month') ?? \Carbon\Carbon::now()->format('Y-m') }}">
                <button type="submit" class="bg-blue-500 text-white rounded px-4 py-2 ml-2">Generate Report</button>
            </div>
            @if (session('status'))
                <div class="bg-green-500 text-white p-2 rounded">
                    {{ session('status') }}
                </div>
            @endif
        </form>

        @if (isset($sales))
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-400 text-center">
                    <thead class="text-xs uppercase bg-gray-700 text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3 w-5">No.</th>
                            <th scope="col" class="px-6 py-3">Order Serial Number</th>
                            <th scope="col" class="px-6 py-3">Game ID</th>
                            <th scope="col" class="px-6 py-3">Server Number</th>
                            <th scope="col" class="px-6 py-3">Product</th>
                            <th scope="col" class="px-6 py-3">Product Code</th>
                            <th scope="col" class="px-6 py-3">Category</th>
                            <th scope="col" class="px-6 py-3">Gross Price</th>
                            <th scope="col" class="px-6 py-3">Status</th>
                            <th scope="col" class="px-6 py-3">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i = 0; @endphp
                        @foreach ($sales as $sale)
                            <tr class="border-b bg-gray-800 border-gray-700">
                                <td class="px-6 py-2">{{ ++$i }}</td>
                                <td class="px-6 py-2">{{ $sale->order_serial_number }}</td>
                                <td class="px-6 py-2">{{ $sale->game_id }}</td>
                                <td class="px-6 py-2">{{ $sale->server_num }}</td>
                                <td class="px-6 py-2">{{ $sale->item }}</td>
                                <td class="px-6 py-2">{{ $sale->product_serial_number }}</td>
                                <td class="px-6 py-2">{{ $sale->name }}</td>
                                <td class="px-6 py-2">@currency($sale->gross_price)</td>
                                <td class="px-6 py-2">{{ $sale->status }}</td>
                                <td class="px-6 py-2">{{ $sale->created_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-4 flex justify-end items-center">
                <!-- Pagination links if necessary -->
                {{ $sales->links() }}
            </div>
            <div class="mt-4 bg-gray-700 p-4 rounded-lg">
                <h3 class="text-xl font-bold text-white">Summary</h3>
                <p class="text-white">Total Sales: @currency($totalSales)</p>
                <p class="text-white">Total Quantity Sold: {{ $totalQuantity }}</p>
            </div>
        @else
            <p class="text-white mt-4">No sales data available for the selected month.</p>
        @endif
    </div>
@endsection
