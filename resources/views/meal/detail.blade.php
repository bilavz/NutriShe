@extends('body.main')

@section('title', 'Calendar and Meal')

@section('container')
    <h2 class="text-3xl font-bold mb-4 text-orange">Calendar and Meal</h2>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Left Column: Meal Tracker Form -->
        <div class="bg-white p-6 rounded-lg shadow-md col-span-1 lg:col-span-1">
            <!-- Section to display meals for today -->
            <h2 class="text-2xl font-bold text-orange">Your meal for today</h2>
            <div id="meal-for-today" class="bg-white p-6 rounded-lg shadow-md">
                <!-- Meals for today will be dynamically updated here -->
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

            <!-- Button to go back to main meal planner -->
            <div class="mt-4">
                <a href="{{ route('meal.index') }}" class="button-orange rounded-lg px-4">Back to Meal Planner</a>
            </div>
        </div>

        <input type="hidden" id="selected-date" name="selected-date">
        <input type="hidden" id="date" name="meal_date" value="">

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const calendar = document.getElementById('calendar');
            const selectedDateInput = document.getElementById('selected-date');
            const dateInput = document.getElementById('date');
            const prevMonthButton = document.getElementById('prev-month');
            const nextMonthButton = document.getElementById('next-month');
            const currentMonthDisplay = document.getElementById('current-month');

            let selectedDate = null;
            let selectedMealOption = null;
            let currentYear = null;
            let currentMonth = null;

    
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

                console.log('Fetching meals for:', selectedDate);

                fetch('{{ route("meal.getMealsByDate") }}', requestData)
                    .then(response => {
                        console.log('Response status:', response.status);
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        console.log('Received meals data:', data);
                        if (data.meals.length === 0) {
                            content = '<div class="text-center text-gray-500">No data</div>';
                        } else {
                            let content = '';
                            data.meals.forEach(meal => {
                                content += `
                                    <div class="flex justify-between mb-3">
                                        <div>
                                            <div class="text-black font-medium">${meal.name}</div>
                                        </div>
                                        <div class="font-medium text-black">${meal.calories} kkal</div>
                                        <div class="text-orange">
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
                            document.getElementById('meal-for-today').innerHTML = content;
                        }
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
        });
    </script>
@endsection
