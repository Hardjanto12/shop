@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <div class="flex flex-row h-screen relative z-0 ">
        <div class="basis-8/12 bg-red-500 relative z-10 overflow-hidden">
            <img src="/img/loginbg.jpg" alt="Login Page Background"
                class="object-none lg:object-right sm:object-center absolute z-10 md:h-screen">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"
                class="absolute transform -rotate-90 left-[500px] top-[170px] z-20 w-full">
                <path fill="#191E29" fill-opacity="1"
                    d="M0,96L48,80C96,64,192,32,288,26.7C384,21,480,43,576,90.7C672,139,768,213,864,245.3C960,277,1056,267,1152,272C1248,277,1344,299,1392,309.3L1440,320L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z">
                </path>
            </svg>
        </div>
        <div class="basis-4/12 relative z-10 bg-[#191E29] flex items-center justify-center px-24 py-40">
            <div class="text-center w-full">
                <form method="POST" action="{{ route('login.custom') }}">
                    @csrf
                    <p class="font-bold text-white text-4xl text-left mb-8">Silahkan <br> Login</p>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="mb-4">
                        <label for="Email" class="flex justify-start text-white font-bold mb-2">Email</label>
                        <input type="text" placeholder="Masukkan email" id="email" class="rounded-md w-full"
                            name="email" value="{{ old('email', $errors->has('email') ? '' : request('email')) }}"
                            required autofocus>
                    </div>
                    <div class="mb-3">
                        <label for="Password" class="flex justify-start text-white font-bold mb-2">Password</label>
                        <input type="password" placeholder="Masukkan password" id="password" class="rounded-md w-full"
                            name="password"
                            value="{{ old('password', $errors->has('password') ? '' : request('password')) }}" required
                            autofocus>
                    </div>
                    <div class="mb-14">
                        <div class="flex items-center">
                            <input type="checkbox" class="rounded" name="remember"
                                value="{{ old('remember') ? 'checked' : '' }}">
                            <label for="remember" class="ml-2 text-white font-bold">Remember me</label>
                        </div>
                    </div>
                    <div class="d-grid mx-auto">
                        <button type="submit"
                            class="btn btn-block text-gray-200 border-neutral-900 bg-orange-600 hover:bg-orange-700 rounded-md hover:text-gray-200 text-icons">Sign
                            in</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    </main>
@endsection
