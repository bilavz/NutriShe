
@extends('body.main')

@section('title', 'Calorie Calculator')

@section('container')

    <div class="">
        <div class="flex items-center justify-center min-h-screen w-100 max-w-md relative">
            <div class="backdrop-blur-md p-8 rounded-3xl shadow-lg max-w-md text-center">
                <h2 class="text-2xl font-bold mb-6">Calorie Calculator</h2>
                <form action="calculate.php" method="POST">
                    {{-- Your Age --}}
                    <div class="mb-2">
                        <input type="number" id="age" name="age" class="w-64 px-5 py-2 box-border h-9 w-32 rounded-full" placeholder="Your Age" required>
                    </div>
                    {{-- <label for="height">Your Height</label> --}}
                    <div class="mb-2">
                        <input type="number" id="height" name="height" class="w-64 px-5 py-2 box-border h-9 w-32 rounded-full" placeholder="Height" required>
                    </div>
                    {{-- <label for="weight">Your Weight</label> --}}
                    <div class="mb-2">
                        <input type="number" id="weight" name="weight" class="w-64 px-5 py-2 box-border h-9 w-32 rounded-full" placeholder="Weight" required>
                    </div>
                    <div class="activity-level">
                        <label class="flex items-center justify-center">Your Activity</label>
                        <input type="radio" id="low" name="activity" value="low">
                        <label for="low">Low Active</label>

                        <input type="radio" id="fairly" name="activity" value="fairly">
                        <label for="fairly">Fairly Active</label>

                        <input type="radio" id="active" name="activity" value="active">
                        <label for="active">Active</label>

                        <input type="radio" id="highly" name="activity" value="highly">
                        <label for="highly">Highly Active</label>
                    </div>
        </div>

                <button type="submit" class="w-64 bg-orange text-black font-semibold py-2 mt-3 rounded-full hover:bg-orange-700/75 focus:outline-none focus:ring-2 focus:ring-orange-500">Calculate</button>
            </form>
        </div>
    </div>
@endsection
