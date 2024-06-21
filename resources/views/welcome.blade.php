<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'NutriShe')</title>
    <link href="{{ asset('css/apps.css') }}" rel="stylesheet">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/favicon.ico') }}"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
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
          @if (session()->has('token'))
          <a href="{{ route('welcome') }}" class="{{ request()->routeIs('welcome') ? 'text-orange font-medium' : 'text-black' }} ml-4">Home</a>
          <a href="{{ route('search') }}" class="{{ request()->routeIs('search') ? 'text-orange font-medium' : 'text-black' }} ml-4">Article</a>
          <a href="{{ route('calculator.calculator') }}" class="{{ request()->routeIs('calculator.calculator') ? 'text-orange font-medium' : 'text-black' }} ml-4">Calorie Calculator</a>
          <a href="{{ route('meal.index') }}" class="{{ request()->routeIs('meal.index') ? 'text-orange font-medium' : 'text-black' }} ml-4">Calorie Tracker</a>
          @endif
        </nav>
        <div class="text-black">
          @if (session()->has('token'))
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
          @else
              <a href="{{ route('login') }}" class="flex items-center space-x-2 text-black-500 hover:text-gray-700">
                  <div>Login</div>
                  <i class="far fa-circle-user fa-2x"></i>
              </a>
          @endif
        </div>
    </header>
    <!-- JUMBOTRON START -->
    <div class="jumbotron" id="home">
      <div class="content">
        <h1 class="font-medium">NutriShe</h1>
        <p class="font-medium">
        
        Nutrishe is a website that helps users calculate food calories based on weight, age, height, and activity level. With this tool, users can find out their daily calorie needs and calculate calories from various food menus. In addition to the calorie counting feature, 
        Nutrishe provides articles on health and nutrition to broaden users' knowledge about healthy
         eating and effective diet tips.
        </p>
        <a href="{{ route('meal.index') }}" class="rsv-now">Track your calories</a>
      </div>

      <div class="jumbotron-img">
        <img src="{{ asset('assets/jumbotron-img.png') }} " alt="" />
      </div>
    </div>
    <!-- JUMBOTRON END -->

    <!-- FEATURES START -->
    <div class="features" id="features">
      <div class="features-container">
        <h1 class="font-medium">Features</h1>

        <a href="{{ route('meal.ai') }}" class="feature">
          <img src="{{ asset('assets/diet-planner.png') }}" alt="Diet Planner Icon" />
          <p class="font-medium">AI Recommend</p>
        </a>

        <a href="{{ route('meal.index') }}" class="feature">
          <img src="{{ asset('assets/meal-tracker.png') }}" alt="Meal Tracker Icon" />
          <p class="font-medium">Meal Tracker</p>
        </a>

        <a href="{{ route('calculator.calculator') }}" class="feature">
          <img src="{{ asset('assets/calories-calculator.png') }}" alt="Log Period Icon" />
          <p class="font-medium">Calorie Calculator</p>
        </a>
      </div>
</div>
    <!-- FEATURES END -->

    <!-- ARTICLES START -->
    <div class="articles-part" id="article">
      <div class="articles-container">
        <h1 class="font-medium">Articles</h1>
        <div class="articles">
          <div class="article">
            <img src="{{ asset('assets/article-1.jpg') }}" alt="Article Image" />
            <h2 class="font-medium">Healthy eating basics</h2>
            <p>
            Eating a healthy, balanced diet is one of the most important things you can do to protect your health. In fact, up to 80% of premature heart disease and stroke can be prevented through your life choices and habits, such as eating a healthy diet and being physicall...
              <a href="https://www.heartandstroke.ca/healthy-living/healthy-eating/healthy-eating-basics">See more</a>
            </p>
          </div>
          <div class="article">
            <img src="{{ asset('assets/article-2.jpg') }}" alt="Article Image" />
            <h2 class="font-medium">Healthy Eating Plate</h2>
            <p>
              Make most of your meal vegetables and fruits – ½ of your plate.
              Aim for color and variety, and remember that potatoes don’t count as vegetables on 
              the Healthy Eating Plate because of their negative impact on blood sugar....
              <a href="https://nutritionsource.hsph.harvard.edu/healthy-eating-plate/">See more</a>
            </p>
          </div>
          <div class="article">
            <img src="{{ asset('assets/article-3.jpg') }}" alt="Article Image" />
            <h2 class="font-medium">A List of 50 Super Healthy Foods</h2>
            <p>
            Many foods are both healthy and tasty. By filling your plate with fruits, vegetables, quality protein sources, and other whole foods, 
            you’ll have meals that are colorful, versatile, and good for you....
              <a href="https://www.healthline.com/nutrition/50-super-healthy-foods">See more</a>
            </p>
          </div>
          <div class="article">
            <img src="{{ asset('assets/article-4.jpg') }}" alt="Article Image" />
            <h2 class="font-medium">Healthy eating</h2>
            <p>
            Healthy eating isn’t about cutting out or focusing on individual foods or nutrients. It’s thinking about your whole diet and eating a 
            variety of foods in the right amounts to give your body what it needs....
              <a href="https://www.bhf.org.uk/informationsupport/support/healthy-living/healthy-eating">See more</a>
            </p>
          </div>
        </div>
        <a href="{{ route('search') }}" class="view-all-btn">See More</a>
      </div>
</div>
    <!-- ARTICLES END -->

    <!-- ABOUT START -->
    <div class="about-us" style="padding-right: 150px; padding-left: 150px;">
      <div class="about-image">
        <img src="{{ asset('assets/desainceria.png') }}" alt="" />
      </div>

      <div class="about-caption">
        <h1 class="font-medium">About Us</h1>
        <h3>
        Nutrishe is a website that helps users calculate food calories based on weight, age, height, and activity. In addition,
        Nutrishe provides articles on health and nutrition to broaden users' knowledge about healthy eating.
        </h3>
      </div>
</div>
    <!-- ABOUT END -->

    <!-- FOOTER START -->
    <div class="footer">
      <div class="footer-container">
        <div class="contact-info">
          <h2>Contact Us</h2>
          <p><i class="fa-brands fa-whatsapp"></i> +62 813-5818-3012</p>
          <p><i class="fa-brands fa-instagram"></i> @nutri.she</p>
          <p><i class="fa-solid fa-location-dot"></i> Malang</p>
        </div>
        <div class="footer-image">
          <img src="{{ asset('assets/footer-img.png') }}" alt="Profile silhouette" />
        </div>
      </div>
      <footer class="bg-gradient-to-r from-pink-200 to-orange-300/75 p-4 mt-6 text-center">
        <p class="text-black font-medium">&copy; 2024 NutriShe</p>
    </footer>
    </div>
    <!-- FOOTER END -->

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>

</body>
</html>



<!-- <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        Fonts
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        Styles
       <style>
            /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */html{line-height:1.15;-webkit-text-size-adjust:100%}body{margin:0}a{background-color:transparent}[hidden]{display:none}html{font-family:system-ui,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji;line-height:1.5}*,:after,:before{box-sizing:border-box;border:0 solid #e2e8f0}a{color:inherit;text-decoration:inherit}svg,video{display:block;vertical-align:middle}video{max-width:100%;height:auto}.bg-white{--tw-bg-opacity: 1;background-color:rgb(255 255 255 / var(--tw-bg-opacity))}.bg-gray-100{--tw-bg-opacity: 1;background-color:rgb(243 244 246 / var(--tw-bg-opacity))}.border-gray-200{--tw-border-opacity: 1;border-color:rgb(229 231 235 / var(--tw-border-opacity))}.border-t{border-top-width:1px}.flex{display:flex}.grid{display:grid}.hidden{display:none}.items-center{align-items:center}.justify-center{justify-content:center}.font-semibold{font-weight:600}.h-5{height:1.25rem}.h-8{height:2rem}.h-16{height:4rem}.text-sm{font-size:.875rem}.text-lg{font-size:1.125rem}.leading-7{line-height:1.75rem}.mx-auto{margin-left:auto;margin-right:auto}.ml-1{margin-left:.25rem}.mt-2{margin-top:.5rem}.mr-2{margin-right:.5rem}.ml-2{margin-left:.5rem}.mt-4{margin-top:1rem}.ml-4{margin-left:1rem}.mt-8{margin-top:2rem}.ml-12{margin-left:3rem}.-mt-px{margin-top:-1px}.max-w-6xl{max-width:72rem}.min-h-screen{min-height:100vh}.overflow-hidden{overflow:hidden}.p-6{padding:1.5rem}.py-4{padding-top:1rem;padding-bottom:1rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.pt-8{padding-top:2rem}.fixed{position:fixed}.relative{position:relative}.top-0{top:0}.right-0{right:0}.shadow{--tw-shadow: 0 1px 3px 0 rgb(0 0 0 / .1), 0 1px 2px -1px rgb(0 0 0 / .1);--tw-shadow-colored: 0 1px 3px 0 var(--tw-shadow-color), 0 1px 2px -1px var(--tw-shadow-color);box-shadow:var(--tw-ring-offset-shadow, 0 0 #0000),var(--tw-ring-shadow, 0 0 #0000),var(--tw-shadow)}.text-center{text-align:center}.text-gray-200{--tw-text-opacity: 1;color:rgb(229 231 235 / var(--tw-text-opacity))}.text-gray-300{--tw-text-opacity: 1;color:rgb(209 213 219 / var(--tw-text-opacity))}.text-gray-400{--tw-text-opacity: 1;color:rgb(156 163 175 / var(--tw-text-opacity))}.text-gray-500{--tw-text-opacity: 1;color:rgb(107 114 128 / var(--tw-text-opacity))}.text-gray-600{--tw-text-opacity: 1;color:rgb(75 85 99 / var(--tw-text-opacity))}.text-gray-700{--tw-text-opacity: 1;color:rgb(55 65 81 / var(--tw-text-opacity))}.text-gray-900{--tw-text-opacity: 1;color:rgb(17 24 39 / var(--tw-text-opacity))}.underline{text-decoration:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.w-5{width:1.25rem}.w-8{width:2rem}.w-auto{width:auto}.grid-cols-1{grid-template-columns:repeat(1,minmax(0,1fr))}@media (min-width:640px){.sm\:rounded-lg{border-radius:.5rem}.sm\:block{display:block}.sm\:items-center{align-items:center}.sm\:justify-start{justify-content:flex-start}.sm\:justify-between{justify-content:space-between}.sm\:h-20{height:5rem}.sm\:ml-0{margin-left:0}.sm\:px-6{padding-left:1.5rem;padding-right:1.5rem}.sm\:pt-0{padding-top:0}.sm\:text-left{text-align:left}.sm\:text-right{text-align:right}}@media (min-width:768px){.md\:border-t-0{border-top-width:0}.md\:border-l{border-left-width:1px}.md\:grid-cols-2{grid-template-columns:repeat(2,minmax(0,1fr))}}@media (min-width:1024px){.lg\:px-8{padding-left:2rem;padding-right:2rem}}@media (prefers-color-scheme:dark){.dark\:bg-gray-800{--tw-bg-opacity: 1;background-color:rgb(31 41 55 / var(--tw-bg-opacity))}.dark\:bg-gray-900{--tw-bg-opacity: 1;background-color:rgb(17 24 39 / var(--tw-bg-opacity))}.dark\:border-gray-700{--tw-border-opacity: 1;border-color:rgb(55 65 81 / var(--tw-border-opacity))}.dark\:text-white{--tw-text-opacity: 1;color:rgb(255 255 255 / var(--tw-text-opacity))}.dark\:text-gray-400{--tw-text-opacity: 1;color:rgb(156 163 175 / var(--tw-text-opacity))}.dark\:text-gray-500{--tw-text-opacity: 1;color:rgb(107 114 128 / var(--tw-text-opacity))}}
        </style>

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head> -->
    <!-- <body class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
            @if (Route::has('login'))
                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
    </body>
</html>  -->
