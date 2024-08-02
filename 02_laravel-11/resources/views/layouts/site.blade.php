<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel 11 - Blog</title>

    @vite(['resources/js/app.js'])
</head>

<body class="px-6 py-8">
    <nav class="md:flex md:items-center md:justify-between">
        <div>
            <a href="{{ route('posts') }}">
                <img src="{{ url('/images/logo.svg') }}" alt="Laracasts Logo" width="165" height="16">
            </a>
        </div>

        <div class="mt-8 flex items-center gap-6 md:mt-0">
            @auth
                Welcome, {{ auth()->user()->name }}
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="text-xs font-bold uppercase">Logout</a>
                </form>
            @else
                <a href="{{ route('register') }}" class="text-xs font-bold uppercase">Register</a>
                <a href="{{ route('login') }}" class="text-xs font-bold uppercase">Login</a>
            @endauth
            <a href="#newsletter"
                class="ml-3 rounded-full bg-blue-500 px-5 py-3 text-xs font-semibold uppercase text-white">
                Subscribe for Updates
            </a>
        </div>
    </nav>

    {{ $slot }}

    <footer id="newsletter"
        class="mt-16 rounded-xl border border-black border-opacity-5 bg-gray-100 px-10 py-16 text-center">
        <img src="{{ url('/images/lary-newsletter-icon.svg') }}" alt="" class="mx-auto -mb-6"
            style="width: 145px;">
        <h5 class="text-3xl">Stay in touch with the latest posts</h5>
        <p class="mt-3 text-sm">Promise to keep the inbox clean. No bugs.</p>

        <div class="mt-10 flex flex-col gap-2">
            <div class="relative mx-auto inline-block rounded-full lg:bg-gray-200">

                <form method="POST" action="{{ route('newsletters.store') }}" class="text-sm lg:flex">
                    @csrf
                    <div class="flex items-center lg:px-5 lg:py-3">
                        <label for="email" class="hidden lg:inline-block">
                            <img src="{{ url('/images/mailbox-icon.svg') }}" alt="mailbox letter">
                        </label>

                        <input id="email" type="text" name="email" placeholder="Your email address"
                            class="py-2 pl-4 focus-within:outline-none lg:bg-transparent lg:py-0">
                    </div>
                    <button type="submit"
                        class="mt-4 rounded-full bg-blue-500 px-8 py-3 text-xs font-semibold uppercase text-white transition-colors duration-300 hover:bg-blue-600 lg:ml-3 lg:mt-0">
                        Subscribe
                    </button>
                </form>
            </div>

            @error('email')
                <span class="text-xs text-red-500">{{ $message }}</span>
            @enderror
        </div>
    </footer>

    @if (session()->has('success'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 4000)" x-show="show"
            class="fixed bottom-3 right-3 rounded-xl bg-blue-500 px-4 py-2 text-sm text-white">
            <p>{{ session('success') }}</p>
        </div>
    @endif

</body>

</html>
