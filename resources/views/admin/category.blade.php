@extends('admin.dashboard')

@section('content')
    <div class="bg-gray-800 p-4 rounded-lg">
        <h2 class="text-2xl font-bold mb-4">Categories</h2>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-400">
                <thead class="text-xs uppercase bg-gray-700 text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3 w-5">No.</th>
                        <th scope="col" class="px-6 py-3">Name</th>
                        <th scope="col" class="px-6 py-3">Code</th>
                        <th scope="col" class="px-6 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 0;
                    @endphp
                    @foreach ($categories as $category)
                        <tr class="border-b bg-gray-800 border-gray-700" data-id="{{ $category->id }}">
                            <td class="px-6 py-2">{{ ++$i }}</td>
                            <td class="px-6 py-2 category-name">{{ $category->name }}</td>
                            <td class="px-6 py-2 category-code">{{ $category->code }}</td>
                            <td class="px-6 py-2 flex space-x-2">
                                <!-- Edit Button -->
                                <button class="text-blue-500 hover:underline"
                                    onclick="openEditModal({{ $category->id }}, '{{ $category->name }}', '{{ $category->code }}')">Edit</button>
                                <!-- Delete Button -->
                                <form action="{{ route('categories.destroy', $category->id) }}" method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete this category?');">
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
        {{-- <div class="mt-4">
            {{ $categories->links() }} <!-- Pagination links -->
        </div> --}}
    </div>

    <!-- Add Modal -->
    <div id="addModal" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-75 hidden">
        <div class="bg-gray-700 p-6 rounded-lg">
            <h2 class="text-2xl font-bold mb-4">Add Category</h2>
            <form id="addForm" onsubmit="submitAddForm(event)">
                @csrf
                <div class="mb-4">
                    <label for="addName" class="block text-sm font-medium text-gray-400">Category Name</label>
                    <input type="text" name="name" id="addName"
                        class="mt-1 block w-full rounded-md bg-gray-700 text-white border-gray-600 focus:ring-indigo-500 focus:border-indigo-500">
                </div>
                <div class="mb-4">
                    <label for="addCode" class="block text-sm font-medium text-gray-400">Category Code</label>
                    <input type="text" name="code" id="addCode"
                        class="mt-1 block w-full rounded-md bg-gray-700 text-white border-gray-600 focus:ring-indigo-500 focus:border-indigo-500">
                </div>
                <div class="flex justify-end space-x-2">
                    <button type="button" class="px-4 py-2 bg-gray-600 rounded hover:bg-gray-700"
                        onclick="closeAddModal()">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-blue-500 rounded hover:bg-blue-600">Add</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Modal -->
    <div id="editModal" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-75 hidden">
        <div class="bg-gray-700 p-6 rounded-lg">
            <h2 class="text-2xl font-bold mb-4">Edit Category</h2>
            <form id="editForm" onsubmit="submitEditForm(event)">
                @csrf
                @method('PUT')
                <input type="hidden" id="editCategoryId">
                <div class="mb-4">
                    <label for="editName" class="block text-sm font-medium text-gray-400">Category Name</label>
                    <input type="text" name="name" id="editName"
                        class="mt-1 block w-full rounded-md bg-gray-700 text-white border-gray-600 focus:ring-indigo-500 focus:border-indigo-500">
                </div>
                <div class="mb-4">
                    <label for="editCode" class="block text-sm font-medium text-gray-400">Category Code</label>
                    <input type="text" name="code" id="editCode"
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

    <!-- Floating Button -->
    <div class="fixed bottom-10 right-10">
        <button class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-full shadow-lg"
            onclick="openAddModal()">+</button>
    </div>
@endsection

@section('scripts')
    <script>
        function openAddModal() {
            document.getElementById('addModal').classList.remove('hidden');
        }

        function closeAddModal() {
            document.getElementById('addModal').classList.add('hidden');
        }

        function submitAddForm(event) {
            event.preventDefault();
            const name = document.getElementById('addName').value;
            const code = document.getElementById('addCode').value;
            const token = document.querySelector('input[name="_token"]').value;

            const formData = new FormData();
            formData.append('name', name);
            formData.append('code', code);
            formData.append('_token', token);

            fetch(`/categories/store`, {
                    method: 'POST',
                    body: formData
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        // Close the modal
                        closeAddModal();
                        location.reload();
                    } else {
                        alert('An error occurred while adding the category.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while adding the category.');
                });
        }

        // edit

        function openEditModal(id, name, code) {
            document.getElementById('editCategoryId').value = id;
            document.getElementById('editName').value = name;
            document.getElementById('editCode').value = code;
            document.getElementById('editModal').classList.remove('hidden');
        }

        function closeEditModal() {
            document.getElementById('editModal').classList.add('hidden');
        }

        function submitEditForm(event) {
            event.preventDefault();
            const id = document.getElementById('editCategoryId').value;
            const name = document.getElementById('editName').value;
            const code = document.getElementById('editCode').value;
            const token = document.querySelector('input[name="_token"]').value;

            const formData = new FormData();
            formData.append('name', name);
            formData.append('_token', token);

            fetch(`/categories/${id}`, {
                    method: 'PUT',
                    body: formData
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        closeEditModal();
                        alert('Category updated successfully!');
                        location.reload();
                    } else {
                        alert('An error occurred while updating the category.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while updating the category.');
                });
        }

        // JavaScript for handling the click event of the floating button
        document.addEventListener('DOMContentLoaded', function() {
            const floatingButton = document.querySelector('.floating-button');
            floatingButton.addEventListener('click', function() {
                openAddModal(); // Call the function to open the add modal
            });
        });
    </script>
@endsection
