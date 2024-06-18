@extends('body.main')

@section('title', 'Meal Planner')

@section('container')
<h2 class="text-3xl font-bold mb-4 text-orange">Meal Planner</h2>
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Left Column: Meal Tracker Form -->
    <div class="bg-white p-6 rounded-lg shadow-md col-span-1 lg:col-span-1">
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
        <div id="meal-options" class="grid grid-cols-3 gap-4 mb-4 text-center">
            <!-- Meal options will be dynamically generated here -->
        </div>
        <div class="mb-4">
            <label class="block text-orange font-medium mb-2">Add your own meal</label>
            <div class="flex flex-col mb-2">
                <div class="flex flex-wrap items-center mb-2">
                    <div class="w-32 pr-4">
                        <div class="text-black font-medium">Meal Name<span class="text-orange"> *</span></div>
                    </div>
                    <input type="text" placeholder="Name" class="border border-gray-300 rounded-lg p-2 flex-1">
                </div>
                <div class="flex flex-wrap items-center mb-2">
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
                </div>
                <div class="flex flex-wrap items-center">
                    <div class="w-50 pr-4">
                        <div class="text-black font-medium">Meal Calorie<span class="text-orange"> *</span></div>
                    </div>
                    <input type="number" placeholder="Calorie" class="border border-gray-300 rounded-lg p-2 flex-1">
                </div>
            </div>
            <button class="button-orange-transparent rounded-lg px-4 mt-2"><span class="text-orange">+ </span>Add your own meal</button>
        </div>


        <div class="mb-4">
            <label for="date" class="block text-orange font-medium mb-2">When did you eat it?</label>
            <div class="flex flex-wrap items-center mb-2">
                <div class="w-32 pr-4">
                    <div class="text-black font-medium">Date<span class="text-orange"> *</span></div>
                </div>
                <input type="text" id="selected-date" class="border border-gray-300 rounded-lg p-2 flex-1 text-gray-500 text-right mb-2" readonly>
                <input type="hidden" id="date" value="">
            </div>
            <button id="log-meal-button" class="button-orange rounded-lg px-4">Log Meal</button>
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
        
        <h2 class="text-2xl font-bold text-orange">Your meal for today</h2>
        <div class="bg-white p-6 rounded-lg shadow-md">
            <div class="flex justify-between mb-3">
                <div>
                    <div class="text-black font-medium">Banana</div>
                </div>
                <div class="font-medium text-black">120 kkal</div>
                <div class="text-orange">
                    <i class="fa-regular fa-trash-can"></i>
                </div>
            </div>
            <div class="flex justify-between mt-2 mb-3">
                <div>
                    <div class="text-black font-medium">Banana</div>
                </div>
                <div class="font-medium text-black">120 kkal</div>
                <div class="text-orange">
                    <i class="fa-regular fa-trash-can"></i>
                </div>
            </div>
            <div class="flex justify-between mt-2 mb-3">
                <div>
                    <div class="text-black font-medium">Banana</div>
                </div>
                <div class="font-medium text-black">120 kkal</div>
                <div class="text-orange">
                    <i class="fa-regular fa-trash-can"></i>
                </div>
            </div>
            <hr>
            <div class="flex justify-between mt-3">
                <div>
                    <div class="text-gray font-medium">Total</div>
                </div>
                <div class="font-medium text-orange">360 kkal</div>
                <div class="text-orange">
                </div>
            </div>
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
        const logMealButton = document.getElementById('log-meal-button');
        const mealSelect = document.getElementById('meal');
        const mealOptionsContainer = document.getElementById('meal-options');
        const prevMonthButton = document.getElementById('prev-month');
        const nextMonthButton = document.getElementById('next-month');
        const currentMonthDisplay = document.getElementById('current-month');

        let selectedDate = null;
        let selectedMealOption = null;
        let currentYear = null;
        let currentMonth = null;

        // Sample data for meals (to be replaced with actual data)
        const mealsData = [
            { name: 'Apple', type: 'fruit' },
            { name: 'Banana', type: 'fruit' },
            { name: 'Chicken', type: 'food' },
            { name: 'Salad', type: 'vegetable' },
            { name: 'Water', type: 'drink' },
            { name: 'Chips', type: 'snack' },
            { name: 'Carrot', type: 'vegetable' },
            { name: 'Orange Juice', type: 'drink' },
            { name: 'Cake', type: 'snack' }
        ];

        function renderMealOptions(filterType) {
            mealOptionsContainer.innerHTML = '';

            mealsData.forEach(meal => {
                if (filterType === 'all' || meal.type === filterType) {
                    const div = document.createElement('div');
                    div.className = 'meal-option border border-gray-300 rounded-lg p-2 flex items-center justify-center';
                    div.textContent = meal.name;

                    div.addEventListener('click', function() {
                        if (selectedMealOption) {
                            selectedMealOption.classList.remove('selected');
                        }

                        div.classList.add('selected');
                        selectedMealOption = div;
                    });

                    mealOptionsContainer.appendChild(div);
                }
            });
        }

        mealSelect.addEventListener('change', function() {
            const selectedOption = mealSelect.value;
            renderMealOptions(selectedOption);
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
                            dateInput.value = `${selectedYear}-${selectedMonth}-${selectedDay}`;
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
                            dateInput.value = `${selectedYear}-${selectedMonth}-${selectedDay}`;
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

        // Set default filter to 'all' and render meal options
        mealSelect.value = 'all';
        renderMealOptions('all');
    });
</script>
@endsection
