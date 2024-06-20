<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing page</title>
    <link href="{{ asset('css/landing.css') }}" rel="stylesheet">
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
            <i class="fa-regular fa-circle-user fa-2x mr-3"></i>
        </div>
    </header>

<div class="flex justify-center items-center h-screen">
    <div class="w-full max-w-2xl">
<div class="backdrop-blur-md p-5 rounded-3xl shadow-lg w-full max-w-2xl">
            <h2 class="text-2xl font-bold text-center mb-6">Generate your meal</h2>
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <!-- Days -->
                <div class="mb-2">
                    <div class="relative">
                    <p>Days</p>
                    <input type="text"
                    name="days"
                    id="days"
                    class="w-full px-2 py-1 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500" placeholder="Ex: 9 days" style="width: 100%; height: 35px;" required autofocus>
                    </div>
                </div>

                <!-- Calories -->
                <div class="mb-2">
                    <div class="relative">
                    <p>Calories</p>
                    <input type="text"
                    name="calories"
                    id="calories"
                    class="w-full px-2 py-1 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500" placeholder="Ex: 1500 calories" style="width: 100%; height: 35px;" required autofocus>
                    </div>
                </div>

                <!-- Dishes -->
                <div class="mb-2">
                    <div class="relative">
                    <p>Dishes</p>
                    <input type="text"
                    name="dishes"
                    id="dishes"
                    class="w-full px-2 py-1 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500" placeholder="Ex: Indonesian dishes" style="width: 100%; height: 35px;" required autofocus>
                    </div>
                </div>

                <!-- Login Button -->
                <div class="flex justify-center">
                        <button type="submit" class="w-64 bg-orange text-black font-semibold py-2 mt-3 rounded-full hover:bg-orange-700/75 focus:outline-none focus:ring-2 focus:ring-orange-500">Generate</button>
                </div>

            </form>
        </div>
    </div>
</div>
   <!-- Footer -->
   <footer class="bg-gradient-to-r from-pink-200 to-orange-300/75 p-4 mt-6 text-center">
        <p class="text-black font-medium">&copy; 2024 NutriShe</p>
    </footer>
</body>
</html>

