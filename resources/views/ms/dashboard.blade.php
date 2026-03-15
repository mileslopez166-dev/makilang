@php($title = 'Dashboard')
@extends('layouts.ms')

@section('content')
    <div class="text-sm mb-3">Movie Recommendation</div>

    <div class="grid grid-cols-3 gap-6 max-w-4xl">
        @foreach(range(1,9) as $i)
            <div class="h-28 bg-gray-300 border border-gray-400 flex items-center justify-center">
                <svg class="w-10 h-10 text-gray-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="3" y="3" width="18" height="18" rx="2"></rect>
                    <path d="M3 15l4-4 4 4 4-6 6 8"></path>
                </svg>
            </div>
        @endforeach
    </div>

    <div class="mt-6 space-y-6">
        @foreach([1,2,3] as $r)
            <div class="flex items-center gap-3">
                <div class="grid grid-cols-3 gap-6 max-w-4xl w-full">
                    @foreach(range(1,3) as $c)
                        <div class="h-28 bg-gray-300 border border-gray-400"></div>
                    @endforeach
                </div>
                <button class="w-8 h-8 rounded-full border border-gray-700 flex items-center justify-center">
                    →
                </button>
            </div>
        @endforeach
    </div>
@endsection