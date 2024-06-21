<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="{{ asset('css/apps.css') }}" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="bg-gradient-to-r from-pink-200 to-orange-300/75 flex justify-center items-center h-screen">
    <div class="w-full max-w-md relative">
        <div class="flex justify-center w-100 h-16 max-w-md">
            <img src="{{ asset('assets/logo.png') }}" alt="Logo">
        </div>
        <div class="backdrop-blur-md p-5 rounded-3xl shadow-lg w-full max-w-md">
            <h2 class="text-2xl font-bold text-center mb-6">Login</h2>
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-2">
                    <div class="relative">
                        <input type="text" id="name" name="name" class="w-full px-5 py-2 border rounded-full focus:outline-none focus:ring-2 focus:ring-orange-500" placeholder="Name" required autofocus>
                        <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                            <img src="{{ asset('assets/username_icon.png') }}" alt="Username Icon" class="w-3.5 h-4">
                        </div>
                    </div>
                    @error('name')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>


                <div class="mb-2">
                    <div class="relative">
                        <input type="password" id="password" name="password" class="w-full px-5 py-2 border rounded-full focus:outline-none focus:ring-2 focus:ring-orange-500" placeholder="Password" required>
                        <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                            <img src="{{ asset('assets/lock_icon.png') }}" alt="Password Icon" class="w-3.5 h-4">
                        </div>
                    </div>
                    @error('password')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex justify-center">
                        <button type="submit" class="w-64 bg-orange text-black font-semibold py-2 mt-3 rounded-full hover:bg-orange-700/75 focus:outline-none focus:ring-2 focus:ring-orange-500">Login</button>
                </div>


                     <div class="remember">
                        <label for="remember_me" class="inline-flex items-center center-label">
                            <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                            <span class="ml-2 text-sm text-gray-600 justify-content: center">{{ __('Remember me') }}</span>
                        </label>
                    </div>
            </form>
        </div>
    </div>
</body>
</html> -->

<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
        <h2 class="text-2xl font-bold text-center mb-6">Login</h2>
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div class="mb-2">
                <div class="relative">
                    <x-input-label for="email" :value="__('Email')" />
                    <input id="email" class="w-full px-5 py-2 border rounded-full focus:outline-none focus:ring-2 focus:ring-orange-500" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                        <img src="{{ asset('assets/username_icon.png') }}" alt="Email Icon" class="w-3.5 h-4">
                    </div>
                </div>
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mb-2">
                <div class="relative">
                    <x-input-label for="password" :value="__('Password')" />
                    <input id="password" class="w-full px-5 py-2 border rounded-full focus:outline-none focus:ring-2 focus:ring-orange-500" type="password" name="password" required autocomplete="current-password" />
                    <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                        <img src="{{ asset('assets/lock_icon.png') }}" alt="Password Icon" class="w-3.5 h-4">
                    </div>
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <!-- Login Button -->
            <div class="flex justify-center">
                <button class="w-64 bg-orange text-black font-semibold py-2 mt-3 rounded-full hover:bg-orange-700/75 focus:outline-none focus:ring-2 focus:ring-orange-500">
                    {{ __('Log in') }}
                </button>
            </div>

             <!-- Register Link -->
             <div class="flex items-center justify-center mt-4">
                @if (Route::has('register'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('register') }}">
                        {{ __('Don\'t have an account? Register') }}
                    </a>
                @endif
            </div>
        </form>
    </div>
</x-guest-layout>
