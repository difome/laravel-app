@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="flex justify-center items-center h-screen">
            <div class="w-full max-w-xs">
                <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                    <h2 class="text-2xl mb-6 text-center">{{ __('Login') }}</h2>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-4">
                            <label for="email" class="block text-gray-700 text-sm font-bold mb-2">{{ __('Email') }}</label>
                            <input id="email" type="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('email') border-red-500 @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password" class="block text-gray-700 text-sm font-bold mb-2">{{ __('Password') }}</label>
                            <input id="password" type="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('password') border-red-500 @enderror" name="password" required autocomplete="current-password">
                            @error('password')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-between mb-6">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                {{ __('Login') }}
                            </button>

                            @if (Route::has('password.request'))
                                <a class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                        </div>
                    </form>

                    <div class="flex justify-center">
                        <p class="text-gray-600">{{ __('Or') }}</p>
                    </div>

                    <div class="flex justify-center">
                        <a href="{{ route('login.github') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold py-2 px-4 rounded inline-flex items-center">
                            <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 0C4.48 0 0 4.48 0 10c0 4.41 2.88 8.14 6.86 9.48.5.09.68-.22.68-.48v-1.72C4.47 17.07 3.94 15.9 3.94 15c0-.77.03-1.5.11-2.2-3.16-.68-3.8-2.35-3.8-2.35-.5-1.22-1.22-1.55-1.22-1.55-1-.68.08-.67.08-.67 1.1.08 1.68 1.1 1.68 1.1.98 1.67 2.58 1.18 3.22.9.1-.7.38-1.17.7-1.44-2.46-.28-5.04-1.23-5.04-5.48 0-1.21.43-2.2 1.1-2.98-.1-.27-.48-1.34.1-2.78 0 0 .9-.28 2.94 1.08a10.33 10.33 0 015.4 0C13.56.28 14.46.55 14.46.55c.58 1.44.2 2.51.1 2.78.67.78 1.1 1.77 1.1 2.98 0 4.26-2.58 5.2-5.05 5.47.4.34.76 1.02.76 2.05v3.03c0 .27.17.58.69.48C17.13 18.14 20 14.41 20 10c0-5.52-4.48-10-10-10z" clip-rule="evenodd" />
                            </svg>
                            <span>{{ __('Login with GitHub') }}</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
