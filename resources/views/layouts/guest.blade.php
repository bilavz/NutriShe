{{-- <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
            <div>
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
        {{-- <div>
            <div>
                <link href="./c_login.css" rel="stylesheet" />
                <div class="c_login-frame">
                  <img
                    src="./assets/6118652.png"
                    alt="rectangle"
                    width="105"
                    height="130"
                    class="c_login-rectangle"
                    />
                  <img
                    src="./assets/84.svg"
                    alt="rectangle"
                    width="859"
                    height="743"
                    class="c_login-rectangle1"
                    />
                  <div class="c_login-text"><p class="c_login-text01">Login</p></div>
                  <div class="c_login-frame1">
                    <div class="c_login-frame2">
                      <div class="c_login-text02"><p class="c_login-text03">Username</p></div>
                      <img
                        src="./assets/5140.svg"
                        alt="frame"
                        width="32"
                        height="32"
                        class="c_login-frame3"
                        />
                    </div>
                    <div class="c_login-frame4">
                      <div class="c_login-text04"><p class="c_login-text05">Password</p></div>
                    </div>
                    <div class="c_login-text06">
                      <p class="c_login-text07">Forgot Password?</p>
                    </div>
                    <div class="c_login-frame5">
                      <div class="c_login-text08"><p class="c_login-text09">Login</p></div>
                    </div>
                    <div class="c_login-text10"><p class="c_login-text11">OR</p></div>
                  </div>
                </div>
              </div>
        </div> --}}
    {{-- </body> --}}
{{-- </html> --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-r from-pink-100 to-orange-100 flex justify-center items-center h-screen">
    <div class="bg-white p-8 rounded-sm shadow-md w-full max-w-md">
        <div class="flex justify-center mb-4">
            <img src="public/assets/logo.png" alt="Logo" class="h-16 w-16"/>
        </div>
        <h2 class="text-2xl font-bold text-center mb-6">Register</h2>
        <form>
            <div class="mb-4">
                {{-- <label class="block mb-1" for="username">Username</label> --}}
                <div class="relative">
                    <input type="text" id="username" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500" placeholder="Username">
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                        <img src="public/assets/username_icon.png" alt="Uname Icon">
                    </div>
                </div>
            </div>
            <div class="mb-4">
                {{-- <label class="block mb-1" for="email">Email</label> --}}
                <div class="relative">
                    <input type="email" id="email" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500" placeholder="Email">
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                        {{-- <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16.5 3a4.992 4.992 0 00-5 0L5.5 7a4.992 4.992 0 000 8l6 3.5a4.992 4.992 0 005 0l6-3.5a4.992 4.992 0 000-8l-6-4zM6 11.5l6 3.5 6-3.5"></path></svg> --}}
                    </div>
                </div>
            </div>
            <div class="mb-4">
                {{-- <label class="block mb-1" for="password">Password</label> --}}
                <div class="relative">
                    <input type="password" id="password" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500" placeholder="Password">
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11V7.5a2.5 2.5 0 015 0v3.5m-7 0V7.5a2.5 2.5 0 115 0v3.5M5 13.5a2.5 2.5 0 01-5 0V7.5a2.5 2.5 0 015 0v3.5m0 0a2.5 2.5 0 015 0v3.5m-5 0a2.5 2.5 0 005 0v3.5m-7 0a2.5 2.5 0 005 0v3.5M5 13.5V7.5m12 6.5a2.5 2.5 0 015 0v3.5a2.5 2.5 0 01-5 0v-3.5m0 0a2.5 2.5 0 00-5 0v3.5m0 0a2.5 2.5 0 00-5 0v3.5m0 0a2.5 2.5 0 00-5 0v3.5m0 0a2.5 2.5 0 00-5 0v3.5m0 0a2.5 2.5 0 00-5 0v3.5"></path></svg>
                    </div>
                </div>
            </div>
            <div class="mb-4">
                {{-- <label class="block mb-1" for="confirm_password">Confirm Password</label> --}}
                <div class="relative">
                    <input type="password" id="confirm_password" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500" placeholder="Confirm Password">
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11V7.5a2.5 2.5 0 015 0v3.5m-7 0V7.5a2.5 2.5 0 115 0v3.5M5 13.5a2.5 2.5 0 01-5 0V7.5a2.5 2.5 0 015 0v3.5m0 0a2.5 2.5 0 015 0v3.5m-5 0a2.5 2.5 0 005 0v3.5m-7 0a2.5 2.5 0 005 0v3.5m0 0a2.5 2.5 0 00-5 0v3.5m0 0a2.5 2.5 0 00-5 0v3.5m0 0a2.5 2.5 0 00-5 0v3.5m0 0a2.5 2.5 0 00-5 0v3.5"></path></svg>
                    </div>
                </div>
            </div>
            <div class="mb-4">
                {{-- <label class="block mb-1" for="dob">Date of Birth</label> --}}
                <div class="relative">
                    <input type="text" id="dob" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500" placeholder="MM/DD/YY">
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4 0h4m-4 0a4 4 0 11-8 0m8 0v4m0 4h8m-8 0a4 4 0 11-8 0m8 0v4"></path></svg>
                    </div>
                </div>
            </div>
            <div class="flex space-x-4 mb-4">
                <div class="w-1/2">
                    {{-- <label class="block mb-1" for="height">Height (in cm)</label> --}}
                    <div class="relative">
                        <input type="number" id="height" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500" placeholder="Height">
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4 0h4m-4 0a4 4 0 11-8 0m8 0v4m0 4h8m-8 0a4 4 0 11-8 0m8 0v4"></path></svg>
                        </div>
                    </div>
                </div>
                <div class="w-1/2">
                    {{-- <label class="block mb-1" for="weight">Weight (in kg)</label> --}}
                    <div class="relative">
                        <input type="number" id="weight" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500" placeholder="Weight">
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4 0h4m-4 0a4 4 0 11-8 0m8 0v4m0 4h8m-8 0a4 4 0 11-8 0m8 0v4"></path></svg>
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="w-full bg-orange-500 text-white py-2 rounded-lg hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-orange-500">Register</button>
        </form>
    </div>
</body>
</html>
