<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'NutriShe Meal Tracker')</title>
    <link href="{{ asset('css/apps.css') }}" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Satisfy:wght@400&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-r from-pink-200 to-orange-300/75 antialiased">

    <!-- Header -->
    <header class="bg-gradient-to-r from-pink-200 to-orange-300/75 p-4 flex justify-between items-center">
        <div class="flex items-center">
            <img src="{{ asset('assets/logo.png') }}" alt="Logo" class="h-12 mr-3 ml-2">
            <img src="{{ asset('assets/NutriShe.png') }}" alt="NutriShe" class="h-9 mr-5">
        </div>
        <nav>
            <a href="#" class="text-orange font-medium mr-4">Home</a>
            <a href="#" class="text-orange font-medium mr-4">Features</a>
            <a href="#" class="text-orange font-medium mr-4">Article</a>
            <a href="#" class="text-orange font-medium">Diet Planner</a>
            <a href="#" class="text-orange font-medium ml-4">Calorie Tracker</a>
        </nav>
        <div class="text-black">
            <!-- Dropdown for User Profile and Logout -->
            <nav x-data="{ open: false }" class="relative">
                <button @click="open = !open" class="flex items-center space-x-2 text-black-500 hover:text-gray-700">
                    <div>{{ session('user')['name'] }}</div>
                    <i class="far fa-circle-user fa-2x"></i>
                </button>

                <!-- Dropdown Content -->
                <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1">
                    <x-dropdown-link :href="route('profile.edit')" class="block px-4 py-2 text-sm text-black hover:bg-gray-100">
                        {{ __('Profile') }}
                    </x-dropdown-link>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-dropdown-link :href="route('logout')" class="block px-4 py-2 text-sm text-black hover:bg-gray-100"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-dropdown-link>
                    </form>
                </div>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main class="p-6">
        <div class="container mx-auto">
            @yield('container')
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gradient-to-r from-pink-200 to-orange-300/75 p-4 mt-6 text-center">
        <p class="text-black font-medium">&copy; 2024 NutriShe</p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
</body>
</html>
