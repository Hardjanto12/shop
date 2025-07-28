<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
	<link rel="stylesheet" href="/css/app.css/">
	
    @yield('styles')
</head>


<body class="bg-gray-900 text-white">
    {{-- <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="w-64 bg-gray-800 p-4">
            <div class="text-2xl font-bold mb-6">Winnn Store</div>
            <ul>
                <li class="mb-4"><a href="{{ route('dashboard') }}"
                        class="block p-2 rounded hover:bg-gray-700">Dashboard</a></li>
                <li class="mb-4"><a href="{{ route('productlist') }}"
                        class="block p-2 rounded hover:bg-gray-700">Products</a></li>
                <li class="mb-4"><a href="{{ route('categorylist') }}"
                        class="block p-2 rounded hover:bg-gray-700">Categories</a></li>
                <li class="mb-4"><a href="{{ route('orderlist') }}"
                        class="block p-2 rounded hover:bg-gray-700">Orders</a></li>
                <li class="mb-4"><a href="{{ route('changepassword') }}"
                        class="block p-2 rounded hover:bg-gray-700">Change
                        Password</a></li>
            </ul>
        </div>
        <!-- Main Content -->
        <div class="flex-1 p-6">
            <!-- Content goes here -->
            @yield('content')
        </div>
            <div class="flex justify-between items-center mb-6">
        <div class="text-xl font-bold">Dashboard</div>
        <a href="{{ route('signout') }}" class="px-4 py-2 bg-red-500 rounded hover:bg-red-600">Sign
            Out</a>
    </div>
    </div> --}}
    <button data-drawer-target="default-sidebar" data-drawer-toggle="default-sidebar" aria-controls="default-sidebar"
        type="button"
        class="inline-flex items-center p-2 mt-2 ms-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
        <span class="sr-only">Open sidebar</span>
        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
            xmlns="http://www.w3.org/2000/svg">
            <path clip-rule="evenodd" fill-rule="evenodd"
                d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
            </path>
        </svg>
    </button>

    <aside id="default-sidebar"
        class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0"
        aria-label="Sidebar">

        <div class="h-full px-3 py-4 overflow-y-auto bg-gray-800">
            <ul class="space-y-2 font-medium">
                <li>
                    <a href="{{ route('sales.report') }}"
                        class="flex items-center p-2  rounded-lg text-white hover:bg-gray-700 group">
                        <span class="material-symbols-outlined">
                            monitoring
                        </span>
                        <span class="ms-3">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('productlist') }}"
                        class="flex items-center p-2  rounded-lg text-white hover:bg-gray-700 group">
                        <span class="material-symbols-outlined">
                            sell
                        </span>
                        <span class="flex-1 ms-3 whitespace-nowrap">Products</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('categorylist') }}"
                        class="flex items-center p-2 rounded-lg text-white hover:bg-gray-700 group">
                        <span class="material-symbols-outlined">
                            category
                        </span>
                        <span class="flex-1 ms-3 whitespace-nowrap">Categories</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('orderlist') }}"
                        class="flex items-center p-2  rounded-lg text-white hover:bg-gray-700 group">
                        <span class="material-symbols-outlined">
                            list_alt
                        </span>
                        <span class="flex-1 ms-3 whitespace-nowrap">Orders</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('changepassword') }}"
                        class="flex items-center p-2  rounded-lg text-white hover:bg-gray-700 group">
                        <span class="material-symbols-outlined">
                            key
                        </span>
                        <span class="flex-1 ms-3 whitespace-nowrap">Change Password</span>
                    </a>
                </li>
                <li>
                    <form action="{{ route('signout') }}" method="POST"
                        class="items-center rounded-lg text-white hover:bg-gray-700 group">
                        @csrf
                        <button type="submit" class="p-2 flex">
                            <span class="material-symbols-outlined">
                                logout
                            </span>
                            <span class="flex-1 ms-3 whitespace-nowrap">Sign Out</span>
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </aside>

    <div class="p-4 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700">
            @yield('content')
        </div>
    </div>

    @yield('scripts')

    <script src="{!! asset('css/app') !!}"></script>
</body>

</html>
