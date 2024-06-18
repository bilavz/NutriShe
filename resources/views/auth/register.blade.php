<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="{{ asset('css/apps.css') }}" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-r from-pink-200 to-orange-300/75 flex justify-center items-center h-screen">
    <div class="w-full max-w-md relative">
        <div class="flex justify-center w-100 h-16 max-w-md">
            <img src="{{ asset('assets/logo.png') }}" alt="Logo">
        </div>
        <div class="backdrop-blur-md p-5 rounded-3xl shadow-lg w-full max-w-md">
            <h2 class="text-2xl font-bold text-center mb-6">Register</h2>
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <!-- Name -->
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

                <!-- Email -->
                <div class="mb-2">
                    <div class="relative">
                        <input type="email" id="email" name="email" class="w-full px-5 py-2 border rounded-full focus:outline-none focus:ring-2 focus:ring-orange-500" placeholder="Email" required>
                        <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                           <img src="{{ asset('assets/carbon_email.png') }}" alt="Email Icon" class="w-3.5 h-4">
                        </div>
                    </div>
                    @error('email')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Password -->
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

                <!-- Confirm Password -->
                <div class="mb-2">
                    <div class="relative">
                        <input type="password" id="password_confirmation" name="password_confirmation" class="w-full px-5 py-2 border rounded-full focus:outline-none focus:ring-2 focus:ring-orange-500" placeholder="Confirm Password" required>
                        <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                            <img src="{{ asset('assets/lock_icon.png') }}" alt="Password Icon" class="w-3.5 h-4">
                        </div>
                    </div>
                </div>

                <!-- Date of Birth -->
                <div class="mb-2">
                    <div class="relative">
                        <input type="text" id="dob" name="dob" class="w-full px-5 py-2 border rounded-full focus:outline-none focus:ring-2 focus:ring-orange-500" placeholder="MM/DD/YY">
                        <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                           <img src="{{ asset('assets/date_icon.png') }}" alt="Date Icon" class="w-3.5 h-4">
                        </div>
                    </div>
                    @error('dob')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Height and Weight -->
                <div class="flex space-x-4 mb-2">
                    <div class="w-1/2">
                        <div class="relative">
                            <input type="number" id="height" name="height" class="w-full px-5 py-2 border rounded-full focus:outline-none focus:ring-2 focus:ring-orange-500" placeholder="Height">
                            <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                <img src="{{ asset('assets/height_icon.png') }}" alt="Height Icon" class="w-3.5 h-4">
                            </div>
                        </div>
                        @error('height')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="w-1/2">
                        <div class="relative">
                            <input type="number" id="weight" name="weight" class="w-full px-5 py-2 border rounded-full focus:outline-none focus:ring-2 focus:ring-orange-500" placeholder="Weight">
                            <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                <img src="{{ asset('assets/weight_icon.png') }}" alt="Weight Icon" class="w-3.5 h-4">
                            </div>
                        </div>
                        @error('weight')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Register Button -->
                <div class="flex justify-center">
                    <button type="submit" class="w-64 bg-orange text-black font-semibold py-2 mt-3 rounded-full hover:bg-orange-700/75 focus:outline-none focus:ring-2 focus:ring-orange-500">Register</button>
                </div>

                <!-- Already Registered Link -->
                <div class="flex justify-center mt-4">
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
