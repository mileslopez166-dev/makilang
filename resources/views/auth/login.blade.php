@if (session('status'))
    <div class="mb-4 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
        {{ session('status') }}
    </div>
@endif

<x-guest-layout>
    <div class="mb-6 text-center">
        <h2 class="text-2xl font-semibold tracking-tight text-slate-900">Log in</h2>
        <p class="mt-2 text-sm text-slate-500">
            Enter your email and password to continue.
        </p>
    </div>

    <x-auth-session-status class="mb-4 rounded-2xl border border-sky-200 bg-sky-50 px-4 py-3 text-sm text-sky-700" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div>
            <x-input-label for="email" class="text-sm font-semibold text-slate-700" :value="__('Email')" />
            <x-text-input
                id="email"
                class="mt-2 block w-full rounded-2xl border-slate-200 bg-slate-50 px-4 py-3 text-slate-900 shadow-none transition focus:border-slate-400 focus:bg-white focus:ring-slate-400"
                type="email"
                name="email"
                :value="old('email')"
                required
                autofocus
                autocomplete="username"
                placeholder="you@example.com"
            />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <div class="flex items-center justify-between">
                <x-input-label for="password" class="text-sm font-semibold text-slate-700" :value="__('Password')" />

                @if (Route::has('password.request'))
                    <a class="text-sm font-medium text-slate-600 transition hover:text-slate-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
            </div>

            <x-text-input
                id="password"
                class="mt-2 block w-full rounded-2xl border-slate-200 bg-slate-50 px-4 py-3 text-slate-900 shadow-none transition focus:border-slate-400 focus:bg-white focus:ring-slate-400"
                type="password"
                name="password"
                required
                autocomplete="current-password"
                placeholder="Enter your password"
            />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mt-5 flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center gap-3 text-sm text-slate-600">
                <input id="remember_me" type="checkbox" class="rounded border-slate-300 text-slate-900 shadow-sm focus:ring-slate-400" name="remember">
                <span>{{ __('Remember me') }}</span>
            </label>

            <a href="{{ route('register') }}" class="text-sm text-slate-500 transition hover:text-slate-800">
                {{ __("Don't have an account?") }} <span class="font-semibold text-slate-900">Register</span>
            </a>
        </div>

        <x-primary-button class="mt-6 flex w-full items-center justify-center rounded-2xl bg-slate-900 px-4 py-3 text-sm font-semibold normal-case tracking-wide transition hover:bg-slate-800 focus:bg-slate-800 active:bg-black">
            {{ __('Log in') }}
        </x-primary-button>
    </form>
</x-guest-layout>
