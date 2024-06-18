
@extends('body.main')

@section('title', 'Calorie Calculator')

@section('container')

    <div class="">
        <div class="flex justify-center items-center w-full max-w-md relative">
            <div class="backdrop-blur-md p-5 rounded-3xl shadow-lg w-full max-w-md">
                <h2 class="text-2xl font-bold text-center mb-6">Calorie Calculator</h2>
                <form action="calculate.php" method="POST">
                    {{-- Your Age --}}
                    <label for="age">Your Age</label>
                    <input type="number" id="age" name="age" required>

                    <label for="height">Your Height</label>
                    <input type="number" id="height" name="height" required>

                    <label for="weight">Your Weight</label>
                    <input type="number" id="weight" name="weight" required>

                    <div class="activity-level">
                        <label>Your Activity</label>
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

                <button type="submit">Calculate</button>
            </form>
        </div>
    </div>
@endsection
