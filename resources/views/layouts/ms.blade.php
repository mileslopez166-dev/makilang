<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'MovieSquare' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-white text-gray-900">
<div class="min-h-screen">

    {{-- Top bar --}}
    <header class="h-16 bg-gray-500 flex items-center justify-between px-6">
        <div class="text-xl font-extrabold italic tracking-wide text-black">
            MOVIE SQUARE
        </div>

        {{-- Search bar (visual only like wireframe) --}}
        <div class="flex items-center gap-3 w-full max-w-xl mx-6">
            <div class="flex items-center bg-gray-200 rounded-full px-4 py-2 w-full">
                <div class="text-sm text-gray-700 mr-2">Search by...</div>

                <div class="ml-auto flex items-center gap-2">
                    <select class="bg-transparent text-sm text-gray-700 outline-none">
                        <option>Title</option>
                        <option>Date</option>
                    </select>
                    <svg class="w-4 h-4 text-gray-700" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="11" cy="11" r="7"></circle>
                        <path d="M21 21l-4.3-4.3"></path>
                    </svg>
                </div>
            </div>
        </div>

        {{-- User menu --}}
        <div x-data="{ open: false }" class="relative">
            <button
                type="button"
                @click="open = !open"
                class="w-11 h-11 rounded-full bg-gray-200 flex items-center justify-center"
            >
                <svg class="w-6 h-6 text-gray-800" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M20 21a8 8 0 0 0-16 0"></path>
                    <circle cx="12" cy="7" r="4"></circle>
                </svg>
            </button>

            <div
                x-cloak
                x-show="open"
                @click.away="open = false"
                class="absolute right-0 mt-2 w-40 rounded-md border border-gray-300 bg-white shadow-lg"
            >
                <a href="{{ route('me') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                    Profile
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="block w-full px-4 py-2 text-left text-sm text-red-600 hover:bg-gray-100">
                        Log Out
                    </button>
                </form>
            </div>
        </div>
    </header>

    <div class="flex">
        {{-- Sidebar --}}
        <aside class="w-24 bg-gray-200 min-h-[calc(100vh-64px)] flex flex-col items-center py-6 gap-8">
            <a href="{{ route('dashboard') }}" class="flex flex-col items-center text-xs">
                <div class="w-10 h-10 rounded-full border border-gray-600 flex items-center justify-center mb-1">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="11" cy="11" r="7"></circle><path d="M21 21l-4.3-4.3"></path>
                    </svg>
                </div>
                <div class="italic">Search</div>
            </a>

            <a href="{{ route('movies.index') }}" class="flex flex-col items-center text-xs">
                <div class="w-10 h-10 rounded-full border border-gray-600 flex items-center justify-center mb-1">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="5" width="18" height="14" rx="2"></rect>
                        <path d="M7 5v14M17 5v14"></path>
                    </svg>
                </div>
                <div class="italic text-center leading-4">Movie<br>Page</div>
            </a>

            <a href="{{ route('me') }}" class="flex flex-col items-center text-xs">
                <div class="w-10 h-10 rounded-full border border-gray-600 flex items-center justify-center mb-1">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M20 21a8 8 0 0 0-16 0"></path><circle cx="12" cy="7" r="4"></circle>
                    </svg>
                </div>
                <div class="italic text-center leading-4">User<br>Profile</div>
            </a>

            <a href="{{ route('payment') }}" class="flex flex-col items-center text-xs">
                <div class="w-10 h-10 rounded-full border border-gray-600 flex items-center justify-center mb-1">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="6" width="18" height="12" rx="2"></rect>
                        <path d="M3 10h18"></path>
                    </svg>
                </div>
                <div class="italic">Payment</div>
            </a>
        </aside>

        {{-- Page content --}}
        <main class="flex-1 p-6">
            @yield('content')
        </main>
    </div>
</div>
</body>
</html>
