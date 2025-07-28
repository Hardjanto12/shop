@extends('admin.dashboard')


@section('content')
    <div class="bg-gray-800 p-4 rounded-lg max-w-lg mx-auto">
        <h2 class="text-2xl font-bold mb-4">Change Password</h2>

        @if (session('status'))
            <div class="bg-green-500 text-white p-2 rounded mb-4">
                {{ session('status') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-500 text-white p-2 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('password.update') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="current_password" class="block text-sm font-medium text-gray-400">Current Password</label>
                <input type="password" name="current_password" id="current_password" required
                    class="mt-1 block w-full rounded-md bg-gray-700 text-white border-gray-600 focus:ring-indigo-500 focus:border-indigo-500">
            </div>
            <div class="mb-4">
                <label for="new_password" class="block text-sm font-medium text-gray-400">New Password</label>
                <input type="password" name="new_password" id="new_password" required
                    class="mt-1 block w-full rounded-md bg-gray-700 text-white border-gray-600 focus:ring-indigo-500 focus:border-indigo-500">
            </div>
            <div class="mb-4">
                <label for="new_password_confirmation" class="block text-sm font-medium text-gray-400">Confirm New
                    Password</label>
                <input type="password" name="new_password_confirmation" id="new_password_confirmation" required
                    class="mt-1 block w-full rounded-md bg-gray-700 text-white border-gray-600 focus:ring-indigo-500 focus:border-indigo-500">
            </div>
            <div class="flex justify-end space-x-2">
                <button type="submit" class="px-4 py-2 bg-blue-500 rounded hover:bg-blue-600">Change Password</button>
            </div>
        </form>
    </div>
@endsection
