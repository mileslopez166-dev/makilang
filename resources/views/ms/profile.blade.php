@php
    $title = 'Profile';
@endphp
@extends('layouts.ms')

@section('content')
    <div class="grid grid-cols-12 gap-6">

        {{-- LEFT PANEL --}}
        <aside class="col-span-3 bg-gray-200 p-4">
            <div class="h-40 bg-gray-600 mb-4"></div>

            <div class="text-xs text-gray-800 mb-4">
                {{ auth()->user()->name }}<br>
                {{ auth()->user()->email }}
            </div>

            <div class="flex gap-4 mb-4">
                <div class="w-10 h-10 bg-gray-300 border border-gray-500"></div>
                <div class="w-10 h-10 bg-gray-300 border border-gray-500"></div>
                <div class="w-10 h-10 bg-gray-300 border border-gray-500"></div>
            </div>

            <div class="text-xs space-y-3">
                <div><b>DASHBOARD</b></div>
                <div>Ratings</div>
                <div>List</div>
                <div>Watchlist</div>
                <div>Checkins</div>
                <div>Review</div>
                <div class="pt-3">Profile Settings</div>
            </div>
        </aside>

        {{-- MIDDLE SECTION --}}
        <section class="col-span-7">

            {{-- Top-Rated Genre box --}}
            <div class="bg-white border border-gray-300 rounded-md p-4 mb-6">
                <div class="flex items-center justify-between">
                    <div class="text-sm font-semibold">Top-Rated Genre</div>
                    <div class="text-sm">⋯</div>
                </div>

                <div class="grid grid-cols-2 gap-6 mt-4 text-xs">
                    @foreach($genres as $g)
                        <div>
                            <div class="mb-2">{{ $g }}</div>
                            <div class="h-1 bg-purple-700 w-24"></div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Watched movies --}}
            <div class="text-xs text-center mb-3 tracking-widest">WATCHED MOVIES</div>

            <div class="grid grid-cols-4 gap-6">
                @foreach(range(1,8) as $m)
                    <div class="text-center">
                        <div class="h-20 bg-gray-300 border border-gray-400 flex items-center justify-center">
                            <div class="w-10 h-10 border border-gray-600"></div>
                        </div>
                        <div class="mt-2 text-xs">Movie {{ $m }}</div>
                    </div>
                @endforeach
            </div>
        </section>

        {{-- RIGHT RECOMMENDED --}}
        <aside class="col-span-2 bg-gray-200 p-4">
            <div class="text-xs font-semibold mb-4 text-right">RECOMMENDED</div>

            <div class="space-y-6">
                @foreach($reco as $name)
                    <div class="text-center">
                        <div class="h-28 bg-gray-700 mb-2"></div>
                        <div class="text-xs">{{ $name }}</div>
                    </div>
                @endforeach
            </div>
        </aside>

    </div>
@endsection
