@extends('body.main')

@section('title', 'Calorie Calculator')

@section('container')
<div class="flex items-center justify-center w-full mt-8">
    <div id="calorieBoxContainer" class="relative">
        <div id="calorieBox" class="backdrop-blur-md p-8 rounded-3xl shadow-lg max-md text-center">
            <h2 class="text-2xl font-bold mb-6">Calorie Calculator</h2>
            <form id="calorieForm">
                {{-- CSRF Token --}}
                @csrf

                {{-- Age Input --}}
                <div class="mb-4 relative">
                    <input type="number" id="age" name="age" class="w-64 px-5 py-2 h-10 w-32 rounded-full focus:outline-none focus:ring-2 focus:ring-orange-500" placeholder="Your Age" required>
                    <span class="absolute inset-y-0 right-0 pr-9 flex items-center text-xs pointer-events-none">Years</span>
                </div>

                {{-- Height Input --}}
                <div class="mb-4 relative">
                    <input type="number" id="height" name="height" class="w-64 px-5 py-2 box-border h-10 w-32 rounded-full focus:outline-none focus:ring-2 focus:ring-orange-500" placeholder="Height" required>
                    <span class="absolute inset-y-0 right-0 pr-9 flex items-center text-xs pointer-events-none">Cm</span>
                </div>

                {{-- Weight Input --}}
                <div class="mb-4 relative">
                    <input type="number" id="weight" name="weight" class="w-64 px-5 py-2 box-border h-10 w-32 rounded-full focus:outline-none focus:ring-2 focus:ring-orange-500" placeholder="Weight" required>
                    <span class="absolute inset-y-0 right-0 pr-9 flex items-center text-xs pointer-events-none">Kg</span>
                </div>

                {{-- Activity Level Input --}}
                <div class="activity-level grid-cols-4 gap-4 content-center">
                    <label class="flex items-center justify-center py-3">Your Activity</label>
                    <div>
                        <input type="radio" id="low" name="activity" value="light">
                        <label for="low">Low Active</label>

                        <input type="radio" id="fairly" name="activity" value="moderate">
                        <label for="fairly">Fairly Active</label>

                        <input type="radio" id="active" name="activity" value="active">
                        <label for="active">Active</label>

                        <input type="radio" id="highly" name="activity" value="very active">
                        <label for="highly">Highly Active</label>
                    </div>
                </div>

                {{-- Calculate Button --}}
                <div>
                    <button id="calculateBtn" type="submit" class="w-64 bg-orange text-black font-semibold py-2 mt-7 rounded-full hover:bg-orange-700/75 focus:outline-none focus:ring-2 focus:ring-orange-500">Calculate</button>
                </div>
            </form>
        </div>

        {{-- Modal for Displaying Calorie Result --}}
        <div id="calorieModal" class="modal absolute inset-0 flex items-center justify-center hidden">
            <div class="modal-content backdrop-blur-none p-8 rounded-3xl shadow-lg max-md text-center">
                <span class="close">&times;</span>
                <p id="calorieResult">You need <span id="caloriesDisplay">X</span> calories per day.</p>
                <button id="closeModalBtn" class="w-64 bg-orange text-black font-semibold py-2 mt-7 rounded-full hover:bg-orange-700/75 focus:outline-none focus:ring-2 focus:ring-orange-500">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('calorieForm');
        const calorieModal = document.getElementById('calorieModal');
        const caloriesDisplay = document.getElementById('caloriesDisplay');

        form.addEventListener('submit', function (event) {
            event.preventDefault();

            const formData = new FormData(form);
            
            formData.set('age', Number(formData.get('age')));
            formData.set('height', Number(formData.get('height')));
            formData.set('weight', Number(formData.get('weight')));

            fetch("{{ route('meal.calculateCalories') }}", {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.calories) {
                    caloriesDisplay.textContent = data.calories.toFixed(2);
                    calorieModal.classList.remove('hidden');
                } else {
                    alert('Failed to calculate calories. Please try again later.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Failed to connect to server. Please try again later.');
            });
            document.getElementById('calorieBox').classList.add('blurred');
        document.getElementById('calorieModal').classList.remove('hidden');
    });

    document.getElementById('closeModalBtn').addEventListener('click', function() {
        document.getElementById('calorieModal').classList.add('hidden');
        document.getElementById('calorieBox').classList.remove('blurred');
    });

    document.querySelector('.modal .close').addEventListener('click', function() {
        document.getElementById('calorieModal').classList.add('hidden');
        document.getElementById('calorieBox').classList.remove('blurred');
    });
    });
</script>
@endsection
