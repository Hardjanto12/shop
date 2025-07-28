<header
    class="header sticky top-0 bg-[#191E29]  shadow-md flex items-center justify-between backdrop-blur-xl bg-[#191E29]/30 px-8 py-02 no-highlights z-50">
    <!-- logo -->
    <a href="#" class="w-3/12 font-semibold">
        <h1 class=" text-slate-300 hover:text-orange-500 hover:underline underline-offset-2 uppercase">
            WinnnStore
        </h1>
    </a>

    <!-- navigation -->
    <nav class="nav font-bold text-sm text-slate-300 w-3/12 flex justify-end">
        <ul class="flex items-center">
            <a href="{{ route('home') }}">
                <li
                    class="p-4 uppercase border-b-4 border-orange-500 border-opacity-0 hover:border-opacity-100 hover:text-orange-500 duration-200 cursor-pointer {{ request()->is('/home') ? 'active' : '' }} active:border-opacity-100 active:text-orange-500">
                    Home
                </li>
            </a>
            <a href="{{ route('mobile-legends') }}">
                <li
                    class="p-4 uppercase border-b-4 border-orange-500 border-opacity-0 hover:border-opacity-100 hover:text-orange-500 duration-200 cursor-pointer {{ request()->is('/mobile-legends') ? 'active' : '' }} active:border-opacity-100 active:text-orange-500">
                    Mobile Legends
                </li>
            </a>
            <a href="{{ route('valorant') }}">
                <li
                    class="p-4 uppercase border-b-4 border-orange-500 border-opacity-0 hover:border-opacity-100 hover:text-orange-500 duration-200 cursor-pointer {{ request()->is('/valorant') ? 'active' : '' }} active:border-opacity-100 active:text-orange-500">
                    Valorant
                </li>
            </a>
        </ul>
    </nav>
</header>


<div class="navbar-menu relative z-50 hidden">
    <div class="navbar-backdrop fixed inset-0 bg-neutral-950 opacity-25"></div>
    <nav
        class="fixed top-0 left-0 bottom-0 flex flex-col w-5/6 max-w-sm py-6 px-6 bg-dark border-r border-main overflow-y-auto">
        <div class="flex items-center mb-8">
            <a class="mr-auto text-3xl font-bold leading-none" href="{{ route('home') }}">
                <img class="object-cover rounded-full object-center bg-second-300 w-10 h-10 overflow-hidden"
                    title="logo" src="/img/kathrinjkt.jpg">
            </a>
            <button class="navbar-close">
                <svg class="h-6 w-6 text-main cursor-pointer hover:text-red-500" title="navbar-close"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </button>
        </div>
        <div>
            <ul>
                <li class="mb-1">
                    <a class="block p-4 text-md font-semibold text-gray-400 hover:bg-red-50 hover:text-theme-pink rounded"
                        href="{{ route('home') }}">Home</a>
                </li>
                <li class="mb-1">
                    <a class="block p-4 text-md font-semibold text-gray-400 hover:bg-red-50 hover:text-theme-pink rounded"
                        href="{{ route('mobile-legends') }}">Mobile Legends</a>
                </li>
                <li class="mb-1">
                    <a class="block p-4 text-md font-semibold text-gray-400 hover:bg-red-50 hover:text-theme-pink rounded"
                        href="{{ route('valorant') }}">Valorant</a>
                </li>
            </ul>
        </div>
        <div class="mt-auto">
            <p class="my-4 text-xs text-center text-gray-400">
                <span>Copyright © 2024</span>
            </p>
        </div>
    </nav>
</div>
