<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>

    {{-- @vite('resources/css/app.css') --}}

</head>
<body class="bg-gray-100">
<div id="app">
    @include('layouts.partials.navbar')

    {{-- <nav class="bg-gray-800 py-6">
        <div class="container mx-auto px-4 flex items-center justify-between">
            <a class="text-lg font-semibold text-white" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>

            <div class="ml-auto">
                @guest
                    <a class="text-white hover:text-gray-300 mx-2" href="{{ route('login') }}">{{ __('Login') }}</a>
                    <a class="text-white hover:text-gray-300 mx-2" href="{{ route('register') }}">{{ __('Register') }}</a>
                @else
                    <div class="relative">
                        <button
                            class="flex text-white items-center focus:outline-none"
                            @click="open = !open"
                        >
                            <img
                                class="h-8 w-8 rounded-full object-cover"
                                src="{{ Storage::url(Auth::user()->avatar) }}"
                                alt="{{ Auth::user()->name }}"
                            >
                            <svg class="ml-2 h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path
                                    d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                <path
                                    d="M10 4a2 2 0 100-4 2 2 0 000 4z"/>
                                <path
                                    d="M10 20a2 2 0 100-4 2 2 0 000 4z"/>
                            </svg>
                        </button>

                        <div
                            x-show="open"
                            @click.away="open = false"
                            class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg"
                            style="display: none;"
                        >
                            <a
                                href="{{ route('logout') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                            >
                                {{ __('Logout') }}
                            </a>

                            <form
                                id="logout-form"
                                action="{{ route('logout') }}"
                                method="POST"
                                style="display: none;"
                            >
                                @csrf
                            </form>
                        </div>
                    </div>
                @endguest
            </div>
        </div>
    </nav> --}}

    <main>
        <div class="mx-auto max-w-7xl mt-7 py-6 sm:px-6">

        @yield('content')
    </div>
    </main>

</div>

</body>
</html>
