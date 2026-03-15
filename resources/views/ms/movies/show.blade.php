@php($title = 'Movie')
@extends('layouts.ms')

@section('content')
    <div class="grid grid-cols-12 gap-6">
        {{-- Main poster box --}}
        <div class="col-span-12 bg-gray-500 h-64 border border-gray-700 flex items-center justify-center">
            <svg class="w-16 h-16 text-gray-800" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <rect x="3" y="3" width="18" height="18" rx="2"></rect>
                <path d="M3 15l4-4 4 4 4-6 6 8"></path>
            </svg>
        </div>

        {{-- Left lines (title/genre placeholders) --}}
        <div class="col-span-4 space-y-4">
            <div class="h-10 bg-white border border-gray-400 flex items-center px-4">
                <div class="h-1 w-28 bg-gray-900"></div>
            </div>
            <div class="h-10 bg-white border border-gray-400 flex items-center px-4">
                <div class="h-1 w-28 bg-gray-900"></div>
            </div>
        </div>

        {{-- Buttons --}}
        <div class="col-span-8 flex items-center gap-6 justify-end">
            <button class="h-10 px-6 bg-white border border-gray-400">Movie Review</button>
            <button class="h-10 px-6 bg-white border border-gray-400">Watch now!</button>
        </div>

        {{-- Thumbnails row --}}
        <div class="col-span-12 flex items-center gap-4 mt-4">
            @foreach(range(1,5) as $t)
                <div class="w-24 h-20 bg-gray-400 border border-gray-600 flex items-center justify-center">
                    <svg class="w-8 h-8 text-gray-700" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="3" width="18" height="18" rx="2"></rect>
                    </svg>
                </div>
            @endforeach

            <button class="ml-auto w-8 h-8 rounded-full border border-gray-700 flex items-center justify-center">
                →
            </button>
        </div>
    </div>
@endsection