<!-- resources/views/products/index.blade.php -->

@extends('layouts.app') <!-- You can adjust the layout based on your application structure -->

@section('title', 'Category')

@section('content')
    <div class="container">
        <p class="text-theme-pink mt-8 mb-4 text-6xl font-bold">Games</p>

        @if (count($categories) > 0)
            <ul class="my-4">
                <div class="grid gap-5 lg:grid-cols-3 md:grid-cols-2 sm:grid-cols-1">
                    @foreach ($categories as $category)
                        <a class="relative w-96 h-96 bg-gray-800 border-3 border-main hover:border-theme-pink rounded-lg shadow hover:shadow-lg hover:bg-red-500 overflow-hidden"
                            href="category/{{ $category->slug }}">
                            <img class="object-cover bg-yellow-300 aspect-square absolute"
                                src="/img/{{ $category->pics }}.jpg" alt="">
                            {{-- <div class="opacity-40 hover:opacity-100">
                                <p class="absolute bottom-5 left-24 text-4xl font-semibold text-main">Read more</p>
                            </div> --}}
                        </a>
                    @endforeach
                </div>
            </ul>
        @else
            <p>No category available.</p>
        @endif
    </div>
@endsection
