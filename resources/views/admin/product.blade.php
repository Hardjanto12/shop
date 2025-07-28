@extends('admin.dashboard')


@section('content')
    <div class="bg-gray-800 p-4 rounded-lg">
        <h2 class="text-2xl font-bold mb-4">Product List</h2>
        {{-- <div id="notification" class="hidden p-4 mb-4 text-sm rounded" role="alert"></div> --}}
        <div id="notification"
            class="fixed hidden flex items-center w-full max-w-xs p-4 space-x-4 divide-x rtl:divide-x-reverse rounded-lg shadow top-5 right-5 text-gray-400 divide-gray-700 space-x bg-gray-800"
            role="alert">
            <div id="notificationIcon"
                class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 rounded-lg bg-green-800 text-green-200">
                <svg id="notificationSvg" class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor" viewBox="0 0 20 20">
                    <path id="notificationPath"
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                </svg>
                <span class="sr-only">Check icon</span>
            </div>
            <div id="notificationMessage" class="px-3 text-sm font-normal">Data fetched successfully.</div>
            <button type="button"
                class="ms-auto -mx-1.5 -my-1.5 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 inline-flex items-center justify-center h-8 w-8 text-gray-500 hover:text-white bg-gray-800 hover:bg-gray-700"
                data-dismiss-target="#notification" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
            </button>
        </div>

        <div class="flex">
            <form action="{{ route('productlist') }}" method="GET" class="mr-auto">
                <select name="category" id="category" class="bg-gray-700 text-white rounded p-2">
                    <option value="all">All Categories</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->code }}"
                            {{ request('category') == $category->code ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                <button type="submit" class="bg-blue-500 text-white rounded px-4 py-2 ml-2">Filter</button>
            </form>
            {{-- <input type="hidden" id="category_id" name="category_id" value="{{ request('category') }}"> --}}
            <form id="fetchAndUpdateForm" class="ml-auto">
                @csrf
                <input type="hidden" id="category_id" name="category_id" value="{{ request('category') }}">
                <button type="submit" id="fetchAndUpdateBtn" class="bg-green-500 text-white rounded px-4 py-2 mb-4">Fetch
                    and Update</button>
            </form>
        </div>


        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-400 text-center">
                <thead class="text-xs uppercase bg-gray-700 text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3 w-5">No.</th>
                        <th scope="col" class="px-6 py-3">Item</th>
                        <th scope="col" class="px-6 py-3">Code</th>
                        <th scope="col" class="px-6 py-3">Price</th>
                        <th scope="col" class="px-6 py-3">Game</th>
                        <th scope="col" class="px-6 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 0;
                    @endphp
                    @foreach ($products as $product)
                        <tr class="border-b bg-gray-800 border-gray-700" data-id="{{ $product->id }}">
                            <td class="px-6 py-2">{{ ++$i }}</td>
                            <td class="px-6 py-2 product-name">{{ $product->item }}</td>
                            <td class="px-6 py-2 product-name">{{ $product->product_serial_number }}</td>
                            <td class="px-6 py-2 product-price">@currency($product->price)</td>
                            <td class="px-6 py-2 product-price">{{ $product->category->name }}</td>

                            <td class="px-6 py-2 flex space-x-2">
                                <!-- Edit Button -->
                                <button class="text-blue-500 hover:underline"
                                    onclick="openEditModal({{ $product->id }}, '{{ $product->item }}', {{ $product->price }})">Edit</button>
                                <!-- Delete Button -->
                                <form action="{{ route('product.destroy', $product->id) }}" method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete this product?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:underline">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-4 flex justify-end items-center">
            {{ $products->onEachSide(1)->links() }} <!-- Pagination links -->
        </div>

    </div>

    <!-- Edit Modal -->
    <div id="editModal" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-75 hidden">
        <div class="bg-gray-700 p-6 rounded-lg">
            <h2 class="text-2xl font-bold mb-4">Edit Product</h2>
            <form id="editForm" onsubmit="submitEditForm(event)">
                @csrf
                @method('PUT')
                <input type="hidden" id="editProductId">
                <div class="mb-4">
                    <label for="editName" class="block text-sm font-medium text-gray-400">Product Name</label>
                    <input type="text" name="name" id="editName"
                        class="mt-1 block w-full rounded-md bg-gray-700 text-white border-gray-600 focus:ring-indigo-500 focus:border-indigo-500">
                </div>
                <div class="mb-4">
                    <label for="editPrice" class="block text-sm font-medium text-gray-400">Product Price</label>
                    <input type="number" name="price" id="editPrice"
                        class="mt-1 block w-full rounded-md bg-gray-700 text-white border-gray-600 focus:ring-indigo-500 focus:border-indigo-500">
                </div>
                <div class="flex justify-end space-x-2">
                    <button type="button" class="px-4 py-2 bg-gray-600 rounded hover:bg-gray-700"
                        onclick="closeEditModal()">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-blue-500 rounded hover:bg-blue-600">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function openEditModal(id, name, price) {
            document.getElementById('editProductId').value = id;
            document.getElementById('editName').value = name;
            document.getElementById('editPrice').value = price;
            document.getElementById('editModal').classList.remove('hidden');
        }

        function closeEditModal() {
            document.getElementById('editModal').classList.add('hidden');
        }

        function submitEditForm(event) {
            event.preventDefault();
            const id = document.getElementById('editProductId').value;
            const name = document.getElementById('editName').value;
            const price = document.getElementById('editPrice').value;
            const token = document.querySelector('input[name="_token"]').value;

            fetch(`/product/edit/${id}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token,
                    },
                    body: JSON.stringify({
                        name: name,
                        price: price
                    })
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        const productRow = document.querySelector(`tr[data-id="${id}"]`);
                        productRow.querySelector('.product-name').innerText = name;
                        productRow.querySelector('.product-price').innerText = price;
                        closeEditModal();
                        alert('Product updated successfully!');
                        location.reload();
                    } else {
                        alert('An error occurred while updating the product.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while updating the product.');
                });
        }
        // fetch and update
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('fetchAndUpdateForm').addEventListener('submit', function(event) {
                event.preventDefault(); // Prevent the default form submission

                const csrfToken = document.querySelector('input[name="_token"]').value;
                const categoryId = document.getElementById('category_id').value;

                fetch('{{ route('fetchAndUpdate') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        },
                        body: JSON.stringify({
                            category_id: categoryId
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'success') {
                            showNotification('Success: Data has been updated.',
                                'bg-green-100 text-green-700');
                        } else {
                            showNotification('Error: ' + data.message, 'bg-red-100 text-red-700');
                        }
                    })
                    .catch(error => {
                        showNotification('Error: ' + error.message, 'bg-red-100 text-red-700');
                    });
            });
        });

        function showNotification(message, isSuccess) {
            const notification = document.getElementById('notification');
            const notificationMessage = document.getElementById('notificationMessage');
            const notificationIcon = document.getElementById('notificationIcon');
            const notificationSvg = document.getElementById('notificationSvg');
            const notificationPath = document.getElementById('notificationPath');

            notificationMessage.textContent = message;

            if (isSuccess) {
                notificationIcon.classList.add('bg-green-800', 'text-green-200');
                notificationIcon.classList.remove('bg-red-800', 'text-red-200');
                notificationSvg.innerHTML =
                    `<path id="notificationPath" d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />`;
            } else {
                notificationIcon.classList.add('bg-red-800', 'text-red-200');
                notificationIcon.classList.remove('bg-green-800', 'text-green-200');
                notificationSvg.innerHTML =
                    `<path id="notificationPath" d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm0 14.207a1 1 0 0 1-1.414 0l-4-4a1 1 0 0 1 1.414-1.414L10 11.793l3.293-3.293a1 1 0 0 1 1.414 1.414l-4 4Z" />`;
            }

            notification.classList.remove('hidden');

            setTimeout(() => {
                notification.classList.add('hidden');
            }, 5000); // Hide after 5 seconds
        }

        document.querySelector('[data-dismiss-target="#notification"]').addEventListener('click', function() {
            document.getElementById('notification').classList.add('hidden');
        });
    </script>
@endsection
