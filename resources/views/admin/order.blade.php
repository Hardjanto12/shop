@extends('admin.dashboard')


@section('content')
    <div class="bg-gray-800 p-4 rounded-lg">
        <h2 class="text-2xl font-bold mb-4">Orders</h2>

        <!-- Filter Form -->
        <form method="GET" action="{{ route('orderlist') }}" class="mb-4">
            <div class="flex items-center mb-4">
                <label class="text-gray-400 mr-2">Category:</label>
                <select name="category_id" class="bg-gray-700 text-white rounded px-4 py-2">
                    <option value="">-- All Categories --</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->code }}" {{ $selectedCategory == $category->code ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>

                <label class="text-gray-400 ml-4 mr-2">
                    <input type="checkbox" name="status" value="success"
                        {{ $selectedStatus == 'success' ? 'checked' : '' }}>
                    Show only success
                </label>

                <button type="submit" class="ml-4 px-4 py-2 bg-blue-500 text-white rounded">Filter</button>
            </div>
        </form>
        {{-- table --}}
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right  text-gray-400">
                <thead class="text-xs  uppercase bg-gray-700 text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">Product Serial Number</th>
                        <th scope="col" class="px-6 py-3">Game ID</th>
                        <th scope="col" class="px-6 py-3">Server Number</th>
                        <th scope="col" class="px-6 py-3">Product</th>
                        <th scope="col" class="px-6 py-3">Gross Price</th>
                        <th scope="col" class="px-6 py-3">Game</th>
                        <th scope="col" class="px-6 py-3">Status</th>
                        <th scope="col" class="px-6 py-3">Created At</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr class="border-b bg-gray-800 border-gray-700">
                            <td class="px-6 py-2">{{ $order->order_serial_number }}</td>
                            <td class="px-6 py-2">{{ $order->game_id }}</td>
                            <td class="px-6 py-2">{{ $order->server_num }}</td>
                            <td class="px-6 py-2">{{ $order->product_serial_number }}</td>
                            <td class="px-6 py-2">@currency($order->gross_price)</td>
                            <td class="px-6 py-2">{{ $order->name }}</td>
                            <td
                                class="px-6 py-2 capitalize {{ $order->status == 'success' ? 'text-green-500' : ($order->status == 'pending' ? 'text-yellow-500' : '') }}">
                                {{ $order->status }}
                            </td>
                            <td class="px-6 py-2">{{ $order->created_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{-- {{ $orders->links() }} --}}
        </div>
    </div>
@endsection
