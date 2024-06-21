@extends('body.main')

@section('title', 'Meal Planner')

@section('container')
<div class="flex justify-center items-center mt-8 mb-8">
    <div class="w-full max-w-2xl">
        <div class="backdrop-blur-md p-5 rounded-3xl shadow-lg w-full max-w-2xl">
            <h2 class="text-2xl font-bold text-center mb-6">Generate your meal</h2>
            <form method="POST" action="{{ route('meal.airesult') }}">
                @csrf
                <!-- Days -->
                <div class="mb-2">
                    <div class="relative">
                        <label for="days" class="block mb-1">Days</label>
                        <input type="text" name="days" id="days" class="w-full px-2 py-1 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500" placeholder="Ex: 9 days" style="width: 100%; height: 35px;" required autofocus>
                    </div>
                </div>

                <!-- Calories -->
                <div class="mb-2">
                    <div class="relative">
                        <label for="calories" class="block mb-1">Calories</label>
                        <input type="text" name="calories" id="calories" class="w-full px-2 py-1 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500" placeholder="Ex: 1500 calories" style="width: 100%; height: 35px;" required autofocus>
                    </div>
                </div>

                <!-- Dishes -->
                <div class="mb-2">
                    <div class="relative">
                        <label for="cuisine" class="block mb-1">Dishes</label>
                        <input type="text" name="cuisine" id="cuisine" class="w-full px-2 py-1 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500" placeholder="Ex: Indonesian dishes" style="width: 100%; height: 35px;" required autofocus>
                    </div>
                </div>

                <!-- Generate Button -->
                <div class="flex justify-center">
                    <button type="submit" class="w-64 bg-orange text-black font-semibold py-2 mt-3 rounded-full hover:bg-orange-700/75 focus:outline-none focus:ring-2 focus:ring-orange-500">Generate</button>
                </div>
            </form>
        </div>
    </div>    
</div>

<div class="flex justify-center items-center">
    <div class="w-full max-w-6xl">
        <div class="backdrop-blur-md p-5 rounded-3xl shadow-xl max-w-6xl">
            {{-- <div class="text"> --}}
                <h2 class="text-2xl font-bold text-center mb-6">Your meal</h2>
                @if (isset($aiResponse))
                <div class="p">
                    <p>{{ $aiResponse }}</p>
                </div>
                @else
                    <p>Waiting for meal generation...</p>
                @endif
        {{-- </div> --}}
        </div>
    </div>
</div>
@endsection
