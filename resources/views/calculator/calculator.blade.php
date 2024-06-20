
@extends('body.main')

@section('title', 'Calorie Calculator')

@section('container')

        <div class="flex items-center justify-center w-full max-md relative">
            <div class="backdrop-blur-md p-8 rounded-3xl shadow-lg max-md text-center">
                <h2 class="text-2xl font-bold mb-6">Calorie Calculator</h2>
                <form action="calculate.php" method="POST">
                    {{-- Your Age --}}
                    <div class="mb-4 relative box-border">
                        <input type="number" id="age" name="age" class="w-64 px-5 py-2 h-10 w-32 rounded-full focus:outline-none focus:ring-2 focus:ring-orange-500" placeholder="Your Age" required>
                        <span class="absolute inset-y-0 right-0 pr-9 flex items-center text-xs pointer-events-none">Years</span>
                    </div>
                    {{-- <label for="height">Your Height</label> --}}
                    <div class="mb-4 relative">
                        <input type="number" id="height" name="height" class="w-64 px-5 py-2 box-border h-10 w-32 rounded-full focus:outline-none focus:ring-2 focus:ring-orange-500" placeholder="Height" required>
                        <span class="absolute inset-y-0 right-0 pr-9 flex items-center text-xs pointer-events-none">Cm</span>
                    </div>
                    {{-- <label for="weight">Your Weight</label> --}}
                    <div class="mb-4 relative">
                        <input type="number" id="weight" name="weight" class="w-64 px-5 py-2 box-border h-10 w-32 rounded-full focus:outline-none focus:ring-2 focus:ring-orange-500" placeholder="Weight" required>
                        <span class="absolute inset-y-0 right-0 pr-9 flex items-center text-xs pointer-events-none">Kg</span>
                    </div>
                    <div class="activity-level grid-cols-4 gap-4 content-center">
                        <label class="flex items-center justify-center py-3">Your Activity</label>
                        <div class="">
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

                    {{-- Calculate Button --}}
                    <div>
                        <button type="submit" class="w-64 bg-orange text-black font-semibold py-2 mt-7 rounded-full hover:bg-orange-700/75 focus:outline-none focus:ring-2 focus:ring-orange-500">Calculate</button>
                    </div>
                </form>
            </div>
        </div>
@endsection
