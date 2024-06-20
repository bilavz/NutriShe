@extends('body.main')

@section('title', 'Meal Planner')

@section('container')
<h2 class="text-3xl font-bold mb-4 text-orange">Meal Planner</h2>
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Left Column: Meal Tracker Form -->
    <div class="bg-white p-6 rounded-lg shadow-md col-span-1 lg:col-span-1">
        <form id="log-meal-form" method="POST" action="{{ route('meal.logMeal') }}">
            @csrf
            <div class="mb-4">
                <label for="meal" class="block text-orange font-medium mb-2">What do you wanna eat?</label>
                <select id="meal" class="w-full border border-gray-300 rounded-lg p-2">
                    <option value="all">Filter by Type</option>
                    <option value="food">Food</option>
                    <option value="drink">Drink</option>
                    <option value="snack">Snack</option>
                    <option value="fruit">Fruit</option>
                    <option value="vegetable">Vegetable</option>
                </select>
            </div>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($foodsByType as $type => $foods)
                    @foreach ($foods as $food)
                        <div class="relative group rounded-lg" data-food-id="{{ $food['food_id'] }}">
                            <div class="meal-option shadow-sm sm:rounded-lg p-4">
                                <div class="font-medium text-center truncate">{{ $food['name'] }}</div>
                            </div>
                            <div class="absolute bg-white p-4 rounded-lg shadow-md hidden group-hover:block z-10 mt-2 w-64">
                                <p class="text-sm font-bold">{{ $food['name'] }}</p>
                                <p class="text-sm">Calories: {{ $food['calories'] }}</p>
                                <p class="text-sm">Fat: {{ $food['fat'] }}g</p>
                                <p class="text-sm">Carbohydrates: {{ $food['carbohydrates'] }}g</p>
                                <p class="text-sm">Protein: {{ $food['protein'] }}g</p>
                                <p class="text-sm">Fiber: {{ $food['fiber'] }}g</p>
                                <p class="text-sm">Calcium: {{ $food['calcium'] }}</p>
                                <p class="text-sm">Type: {{ $food['type'] }}</p>
                            </div>
                        </div>
                    @endforeach
                @endforeach
            </div>
            

                                <!-- <div class="flex flex-wrap items-center mb-2">
                        <div class="w-50 pr-4" style="padding-right: 5px;">
                            <div class="text-black font-medium">Meal Amount<span class="text-orange"> *</span></div>
                        </div>
                        <div class="flex flex-wrap items-center flex-1">
                            <input type="number" placeholder="Amount" class="border border-gray-300 rounded-lg p-2 flex-1 w-24 m-1">
                            <select class="border border-gray-300 rounded-lg p-2 w-24">
                                <option value="gram">gram</option>
                                <option value="ml">ml</option>
                                <option value="ounce">ounce</option>
                                <option value="cup">cup</option>
                                <option value="teaspoon">teaspoon</option>
                                <option value="tablespoon">tablespoon</option>
                                <option value="slice">slice</option>
                                <option value="piece">piece</option>
                                <option value="bowl">bowl</option>
                                <option value="glass">glass</option>
                            </select>
                        </div>
                    </div> -->

            <div class="mt-3 mb-4">
                <label for="date" class="block text-orange font-medium mb-2">When will you eat it?</label>
                <div class="flex flex-wrap items-center mb-2">
                    <div class="w-32 pr-4">
                        <div class="text-black font-medium">Date<span class="text-orange"> *</span></div>
                    </div>
                    <input type="text" id="selected-date" class="border border-gray-300 rounded-lg p-2 flex-1 text-gray-500 text-right mb-2" readonly>
                    <input type="hidden" id="date" name="meal_date" value="">
                    <input type="hidden" id="food_id" name="food_id">
                </div>
                <button type="submit" id="log-meal-button" class="button-orange rounded-lg px-4">Log Meal</button>
            </div>
        </form>
        <div class="mt-4 mb-4">
            <label class="block text-orange font-medium mb-2">Add your own meal</label>
            <form method="POST" action="{{ route('meal.addFood') }}">
                @csrf
                <div class="flex flex-col mb-2">
                    <div class="flex flex-wrap items-center mb-2">
                        <div class="w-32 pr-4">
                            <div class="text-black font-medium">Meal Name<span class="text-orange"> *</span></div>
                        </div>
                        <input type="text" name="name" placeholder="name" class="border border-gray-300 rounded-lg p-2 flex-1">
                    </div>

                    <div class="flex flex-wrap items-center mb-2">
                        <div class="w-50 pr-4">
                            <div class="text-black font-medium">Meal Serving<span class="text-orange"> *</span></div>
                        </div>
                        <input type="number" name="serving" placeholder="serving" class="border border-gray-300 rounded-lg p-2 flex-1">
                    </div>
                    <div class="flex flex-wrap items-center">
                        <div class="w-50 pr-4">
                            <div class="text-black font-medium">Meal Calorie<span class="text-orange"> *</span></div>
                        </div>
                        <input type="number" name="calories" placeholder="calories" class="border border-gray-300 rounded-lg p-2 flex-1">
                    </div>
                </div>
                <button type="submit" class="button-orange-transparent rounded-lg px-4 mt-2"><span class="text-orange">+ </span>Add your own meal</button>
            </form>
        </div>
    </div>

            
        

    <!-- Middle Column: Calendar -->
    <div class="grid gap-3 col-span-1 lg:col-span-1 lg:col-start-2">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <div class="flex justify-between items-center mb-4">
                <!-- Previous Month Button -->
                <button id="prev-month" class="navigation-button">
                    <i class="fas fa-chevron-left"></i>
                </button>

                <!-- Current Month Display -->
                <h2 id="current-month" class="text-2xl font-bold text-orange"></h2>

                <!-- Next Month Button -->
                <button id="next-month" class="navigation-button">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
            <div id="calendar" class="overflow-hidden">
                <!-- Calendar will be dynamically generated here -->
            </div>
        </div>
            
        <img src="{{ asset('assets/article.png') }}" alt="Article">
        
        <!-- Section to display meals for today -->
        <h2 class="text-2xl font-bold text-orange">Your meal for today</h2>
        <div id="meal-for-today" class="bg-white p-6 rounded-lg shadow-md">
            <!-- Meals for today will be dynamically updated here -->
        </div>



    </div>

    <!-- Right Column: Calorie Tracker -->
    <div class="grid gap-3 col-span-1 lg:col-span-1 lg:col-start-3">
        <!-- Today's Calories -->
        <h2 class="text-2xl font-bold text-orange">Today's Calories</h2>
        <div class="bg-white p-6 rounded-lg shadow-md">
            <div class="text-center mb-2">
                <div class="text-4xl font-bold text-orange">1560</div>
                <div class="font-medium text-black">calories</div>
            </div>
            <hr>
            <div class="text-center mt-2 mb-2">
                <div class="text-lg font-medium text-orange">1579 <span class="text-black">calories</span></div>
                <div class="text-gray font-medium">Target per-day</div>
            </div>
            <div class="text-center">
                <div class="text-lg font-medium text-black">1560 calories</div>
                <div class="text-gray font-medium">Yesterday</div>
            </div>
        </div>

        <!-- Calories Goals -->
        <h2 class="text-2xl font-bold text-orange">Calories Goals</h2>
        <div class="bg-white p-6 rounded-lg shadow-md">
            <div class="flex justify-between mb-2">
                <div>
                    <div class="text-gray font-medium">Started at</div>
                </div>
                <div class="font-medium text-black">June 1, 2024</div>
            </div>
            <div class="flex justify-between mt-2 mb-2">
                <div>
                    <div class="text-gray font-medium">Ended at</div>
                </div>
                <div class="font-medium text-black">July 3, 2024</div>
            </div>
            <hr>
            <div class="mt-2 mb-2">
                <div class="font-medium text-xl text-black mb-2">Day 13</div>
                <div class="font-medium text-orange">30 days <span class="text-gray">to go</span></div>
            </div>
            <hr>
            <div class="flex justify-between mt-3">
                <div>
                    <div class="text-black text-xl font-medium">Excess calories</div>
                </div>
                <div class="font-medium text-xl text-orange">3200 calories</div>
            </div>
        </div>

        <!-- This Month's Calories -->
        <h2 class="text-2xl font-bold text-orange">This Month's Calories</h2>
        <div class="bg-white p-6 rounded-lg shadow-md">
            <div class="text-center mb-2">
                <div class="text-lg font-medium text-black">1590 calories</div>
                <div class="text-gray font-medium">Average per-day</div>
            </div>
            <hr>
            <div class="text-center mt-2">
                <div class="text-lg font-medium text-black">36575 calories</div>
                <div class="text-gray font-medium">Total calories</div>
            </div>
        </div>
    </div>

</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const calendar = document.getElementById('calendar');
        const selectedDateInput = document.getElementById('selected-date');
        const dateInput = document.getElementById('date');
        const prevMonthButton = document.getElementById('prev-month');
        const nextMonthButton = document.getElementById('next-month');
        const currentMonthDisplay = document.getElementById('current-month');
        const filterType = "{{ $filterType }}";

        let selectedDate = null;
        let selectedMealOption = null;
        let currentYear = null;
        let currentMonth = null;

        // Sample data for meals (to be replaced with actual data)
        // const mealsData = [
        //     { name: 'Apple', type: 'fruit' },
        //     { name: 'Banana', type: 'fruit' },
        //     { name: 'Chicken', type: 'food' },
        //     { name: 'Salad', type: 'vegetable' },
        //     { name: 'Water', type: 'drink' },
        //     { name: 'Chips', type: 'snack' },
        //     { name: 'Carrot', type: 'vegetable' },
        //     { name: 'Orange Juice', type: 'drink' },
        //     { name: 'Cake', type: 'snack' }
        // ];

        // function fetchMealData(filterType) {
        //     console.log('Fetching meal data for filter:', filterType);
        //     fetch('{{ route('meal.index') }}')
        //         .then(response => {
        //             if (!response.ok) {
        //                 throw new Error('Network response was not ok');
        //             }
        //             return response.json();
        //         })
        //         .then(data => {
        //             console.log('Fetched meal data:', data);
        //             renderMealOptions(data, filterType);
        //         })
        //         .catch(error => {
        //             console.error('Error fetching meal data:', error);
        //         });
        // }


        // function renderMealOptions(foodsByType, filterType) {
        //         mealOptionsContainer.innerHTML = '';

        //         Object.keys(foodsByType).forEach(type => {
        //             if (filterType === 'all' || type === filterType) {
        //                 const typeLabel = document.createElement('div');
        //                 typeLabel.className = 'text-lg font-bold mt-4 mb-2';
        //                 typeLabel.textContent = type.charAt(0).toUpperCase() + type.slice(1); // Capitalize first letter

        //                 mealOptionsContainer.appendChild(typeLabel);

        //                 foodsByType[type].forEach(meal => {
        //                     const div = document.createElement('div');
        //                     div.className = 'meal-option border border-gray-300 rounded-lg p-2 flex items-center justify-center';
        //                     div.textContent = meal['Name']; // Perbaiki akses ke 'Name'

        //                     mealOptionsContainer.appendChild(div);
        //                 });
        //             }
        //         });
        //     }

        // mealSelect.addEventListener('change', function() {
        //     const selectedOption = mealSelect.value;
        //     renderMealOptions(selectedOption);
        // });

        // fetchMealData('all');

        const foodItems = document.querySelectorAll('.meal-option');
        const logMealButton = document.getElementById('log-meal-button');

        
        foodItems.forEach(foodItem => {
            foodItem.addEventListener('click', function() {
                console.log('Item clicked');
                const foodId = foodItem.closest('.relative').getAttribute('data-food-id');
                const foodName = foodItem.querySelector('.font-medium').textContent;
                console.log('Food ID:', foodId);
                console.log('Food Name:', foodName);
                
                // Toggle 'selected-food' class for the clicked item
                if (foodItem.classList.contains('selected-food')) {
                    foodItem.classList.remove('selected-food');
                } else {
                    foodItems.forEach(otherFoodItem => {
                        otherFoodItem.classList.remove('selected-food');
                    });
                    foodItem.classList.add('selected-food');
                }
            });
        });

        // Event listener for log meal form submission
        logMealButton.addEventListener('click', function(event) {
            // Validate if a food item is selected
            const selectedFoodItem = document.querySelector('.selected-food');
            if (!selectedFoodItem) {
                alert('Please select a meal option.');
                event.preventDefault(); // Prevent form submission if no meal is selected
            } else {
                const foodId = selectedFoodItem.closest('.relative').getAttribute('data-food-id');
                console.log('Submitting form with Food ID:', foodId);
                
                document.getElementById('food_id').value = foodId;
                document.getElementById('log-meal-form').submit();
            }
        });

        function renderCalendar(month, year) {
            const daysInMonth = new Date(year, month + 1, 0).getDate();
            const firstDayOfMonth = new Date(year, month, 1).getDay();

            // Clear previous calendar
            calendar.innerHTML = '';

            // Create table for days
            const table = document.createElement('table');
            table.className = 'table-auto';

            // Create table head (week days)
            const thead = document.createElement('thead');
            const tr = document.createElement('tr');
            const weekdays = ['S', 'M', 'T', 'W', 'T', 'F', 'S'];

            weekdays.forEach(day => {
                const th = document.createElement('th');
                th.textContent = day;
                tr.appendChild(th);
            });

            thead.appendChild(tr);
            table.appendChild(thead);

            // Create table body (days)
            const tbody = document.createElement('tbody');
            let date = 1;

            // Create rows
            for (let i = 0; i < 6; i++) {
                const tr = document.createElement('tr');

                // Create cells
                for (let j = 0; j < 7; j++) {
                    const td = document.createElement('td');
                    td.textContent = '';

                    if (i === 0 && j < firstDayOfMonth) {
                        // Empty cells before the first day of the month
                        tr.appendChild(td);
                    } else if (date > daysInMonth) {
                        // Break if we've added all days
                        break;
                    } else {
                        td.textContent = date;
                        td.addEventListener('click', function() {
                            // Remove the 'selected' class from previously selected td
                            const selectedDate = document.querySelector('.selected');
                            if (selectedDate) {
                                selectedDate.classList.remove('selected');
                            }

                            // Add the 'selected' class to the current td
                            td.classList.add('selected');

                            // Update selected date input fields
                            const selectedDay = td.textContent;
                            const selectedMonth = month + 1; // Month is zero-indexed
                            const selectedYear = year;

                            // Format the date as "Month Day, Year"
                            const months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
                            selectedDateInput.value = `${months[month]} ${selectedDay}, ${selectedYear}`;
                            const formattedDate = `${selectedYear}-${selectedMonth.toString().padStart(2, '0')}-${selectedDay.toString().padStart(2, '0')}`;
                            dateInput.value = formattedDate;
                            refreshMealsForToday(formattedDate);
                        });

                        // Highlight today's date
                        const today = new Date();
                        if (date === today.getDate() && year === today.getFullYear() && month === today.getMonth()) {
                            td.classList.add('selected');

                            // Update selected date input fields for today's date
                            const selectedDay = today.getDate();
                            const selectedMonth = today.getMonth() + 1; // Month is zero-indexed
                            const selectedYear = today.getFullYear();

                            // Format the date as "Month Day, Year"
                            const months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
                            selectedDateInput.value = `${months[today.getMonth()]} ${selectedDay}, ${selectedYear}`;
                            const formattedDate = `${selectedYear}-${selectedMonth.toString().padStart(2, '0')}-${selectedDay.toString().padStart(2, '0')}`;
                            dateInput.value = formattedDate;
                            refreshMealsForToday(formattedDate);
                        }


                        tr.appendChild(td);
                        date++;
                    }
                }
                tbody.appendChild(tr);
            }

            table.appendChild(tbody);
            calendar.appendChild(table);

            // Update current month display
            const months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
            currentMonthDisplay.textContent = `${months[month]} ${year}`;
        }

        function refreshMealsForToday(selectedDate) {
            const requestData = {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ meal_date: selectedDate })
            };

            fetch('{{ route("meal.getMealsByDate") }}', requestData)
                .then(response => response.json())
                .then(data => {
                    let content = '';
                    if (!data || !data.meals || data.meals.length === 0) {
                        content = '<div class="text-center justify-center text-gray-500">No data</div>';
                    } else {
                        data.meals.forEach(meal => {
                            content += `
                                <div class="meal-item">
                                    <div class="meal-name">
                                        <div class="text-black font-medium">${meal.name}</div>
                                    </div>
                                    <div class="meal-calories font-medium text-black">${meal.calories} kkal</div>
                                    <div class="meal-action">
                                        <i class="fa-regular fa-trash-can"></i>
                                    </div>
                                </div>
                            `;
                        });
                        content += `
                            <hr>
                            <div class="flex justify-between mt-3">
                                <div>
                                    <div class="text-gray font-medium">Total</div>
                                </div>
                                <div class="font-medium text-orange">${data.totalCalories} kkal</div>
                                <div class="text-orange"></div>
                            </div>
                        `;
                    }
                    document.getElementById('meal-for-today').innerHTML = content;
                })
                .catch(error => {
                    console.error('Error fetching meals for today:', error);
                });
        }

        // Event listener for date change in calendar
        selectedDateInput.addEventListener('change', function() {
            refreshMealsForToday(selectedDateInput.value);
        });


        // Navigation functions
        function goToPreviousMonth() {
            currentMonth--;
            if (currentMonth < 0) {
                currentMonth = 11;
                currentYear--;
            }
            renderCalendar(currentMonth, currentYear);
        }

        function goToNextMonth() {
            currentMonth++;
            if (currentMonth > 11) {
                currentMonth = 0;
                currentYear++;
            }
            renderCalendar(currentMonth, currentYear);
        }

        // Event listeners for navigation buttons
        prevMonthButton.addEventListener('click', goToPreviousMonth);
        nextMonthButton.addEventListener('click', goToNextMonth);

        // Initial render for the current month and year
        const currentDate = new Date();
        currentMonth = currentDate.getMonth();
        currentYear = currentDate.getFullYear();
        renderCalendar(currentMonth, currentYear);
        // refreshMealsForToday(currentDate.toISOString().split('T')[0]); // Initial fetch for today's meals

        // Set default filter to 'all' and render meal options
        // mealSelect.value = 'all';
        // renderMealOptions('all');
    });
</script>
@endsection
