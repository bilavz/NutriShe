<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>NutriShe Meal Tracker</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-pink-50 font-sans">
  <header class="bg-pink-200 p-4 flex justify-between items-center">
    <div class="text-2xl font-bold text-pink-800">
      <img src="logo.png" alt="NutriShe Logo" class="inline-block h-8 mr-2">NutriShe
    </div>
    <nav>
      <a href="#" class="text-pink-800 mx-2">Home</a>
      <a href="#" class="text-pink-800 mx-2">Features</a>
      <a href="#" class="text-pink-800 mx-2">Article</a>
      <a href="#" class="text-pink-800 mx-2">Diet Planner</a>
      <a href="#" class="text-pink-800 mx-2">Calorie Tracker</a>
      <a href="#" class="text-pink-800 mx-2"><img src="profile-icon.png" alt="Profile" class="inline-block h-6"></a>
    </nav>
  </header>

  <main class="p-8">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
      <div class="bg-white p-6 rounded-lg shadow">
        <h2 class="text-2xl font-bold text-orange-500 mb-4">Meal Tracker</h2>
        <div class="mb-4">
          <label for="meal" class="block text-sm font-medium text-gray-700">What did you eat today?</label>
          <select id="meal" name="meal" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring focus:ring-orange-500 focus:ring-opacity-50">
            <option>Choose Meal</option>
            <option>Banana (1)</option>
            <option>Apple (1)</option>
            <option>Bread (1)</option>
            <option>Pear (1)</option>
            <option>Avocado (1)</option>
            <option>Egg (1)</option>
            <option>Carrot (1)</option>
            <option>Orange (1)</option>
            <option>Oat (100 gram)</option>
            <option>Milk (150ml)</option>
            <option>Tea (150ml)</option>
            <option>Coffee (150ml)</option>
            <option>Chicken 150 gr</option>
            <option>Beef (100 gram)</option>
            <option>Potato (1)</option>
          </select>
        </div>
        <div class="mb-4">
          <label for="meal-name" class="block text-sm font-medium text-gray-700">Add your own meal</label>
          <input type="text" id="meal-name" name="meal-name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring focus:ring-orange-500 focus:ring-opacity-50" placeholder="Name">
          <input type="number" id="meal-amount" name="meal-amount" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring focus:ring-orange-500 focus:ring-opacity-50" placeholder="Amount (gram)">
          <input type="number" id="meal-calorie" name="meal-calorie" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring focus:ring-orange-500 focus:ring-opacity-50" placeholder="Calorie">
          <button class="mt-2 w-full bg-orange-500 text-white py-2 rounded-md">Add your own meal</button>
        </div>
        <div class="mb-4">
          <label for="meal-time" class="block text-sm font-medium text-gray-700">When did you eat it?</label>
          <input type="date" id="meal-time" name="meal-time" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring focus:ring-orange-500 focus:ring-opacity-50">
          <input type="time" id="meal-time" name="meal-time" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring focus:ring-orange-500 focus:ring-opacity-50">
          <button class="mt-2 w-full bg-orange-500 text-white py-2 rounded-md">Log Meal</button>
        </div>
      </div>
      <div class="bg-white p-6 rounded-lg shadow">
        <div class="flex justify-between items-center mb-4">
          <h2 class="text-2xl font-bold text-orange-500">Today's Calories</h2>
          <span class="text-gray-700">June 2024</span>
        </div>
        <div class="text-center text-4xl font-bold text-orange-500 mb-2">1560</div>
        <div class="text-center text-sm text-gray-500 mb-6">
          1579 calories (Target per-day)
          <br>
          1560 calories (Yesterday)
        </div>
        <h3 class="text-xl font-bold text-orange-500 mb-2">Calories Goals</h3>
        <div class="text-gray-700 mb-4">
          <div>Started at: June 1, 2024</div>
          <div>Ended at: July 3, 2024</div>
          <div>Day 13</div>
          <div>30 days to go</div>
          <div>Excess calories: 3200 calories</div>
          <div>End date extended by 3 days</div>
        </div>
        <h3 class="text-xl font-bold text-orange-500 mb-2">This Month's Calories</h3>
        <div class="text-gray-700">
          <div>1590 calories (Average per-day)</div>
          <div>36575 calories (Total calories)</div>
        </div>
      </div>
    </div>
    <div class="mt-8 bg-white p-6 rounded-lg shadow">
      <h2 class="text-2xl font-bold text-orange-500 mb-4">What you ate today</h2>
      <div class="overflow-auto">
        <table class="min-w-full bg-white">
          <thead>
            <tr>
              <th class="py-2 px-4 border-b border-gray-200">Time</th>
              <th class="py-2 px-4 border-b border-gray-200">Calories</th>
              <th class="py-2 px-4 border-b border-gray-200">Meal</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="py-2 px-4 border-b border-gray-200">08:45 AM</td>
              <td class="py-2 px-4 border-b border-gray-200">120 kcal</td>
              <td class="py-2 px-4 border-b border-gray-200">Banana (1)</td>
            </tr>
            <tr>
              <td class="py-2 px-4 border-b border-gray-200">08:45 AM</td>
              <td class="py-2 px-4 border-b border-gray-200">120 kcal</td>
              <td class="py-2 px-4 border-b border-gray-200">Banana (1)</td>
            </tr>
            <tr>
              <td class="py-2 px-4 border-b border-gray-200">08:45 AM</td>
              <td class="py-2 px-4 border-b border-gray-200">120 kcal</td>
              <td class="py-2 px-4 border-b border-gray-200">Apple (1)</td>
            </tr>
            <tr>
              <td class="py-2 px-4 border-b border-gray-200 text-right font-bold">Total</td>
              <td class="py-2 px-4 border-b border-gray-200 text-right font-bold">360 kcal</td>
              <td class="py-2 px-4 border-b border-gray-200"></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </main>
</body>
</html>
