
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="{{ asset('css/apps.css') }}" rel="stylesheet">
        <script src="https://cdn.tailwindcss.com"></script>

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="bg-gradient-to-r from-pink-200 to-orange-300/75 flex justify-center items-center h-screen" style="width: 100%; height: 100%;">
            <div class="w-full max-w-md relative">
                <div class="flex justify-center w-100 h-16 max-w-md">
                    <img src="{{ asset('assets/logo.png') }}" alt="Logo">
                </div>
                <div class="backdrop-blur-md p-5 rounded-3xl shadow-lg w-full max-w-md">
                {{ $slot }}
                </div>
            </div>
        </div>
    </body>
</html>
