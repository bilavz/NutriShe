<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MealController;
use App\Http\Controllers\LandingController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Route::get('/meal', function () {
//     return view('meal.index');
// })->middleware(['web', 'check.api.token'])->name('meal.index');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['web', 'check.api.token'])->name('dashboard');

Route::middleware(['web', 'check.api.token'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::get('/meal', [MealController::class, 'index'])->name('meal.index');
    Route::post('/logmeal', [MealController::class, 'logMeal'])->name('meal.logMeal');
    Route::get('/article', [MealController::class, 'search'])->name('search');
    Route::post('/article/result', [MealController::class, 'searchArticles'])->name('searchArticles');
    Route::get('/meal/show', [MealController::class, 'show'])->name('meal.show');
    Route::post('/meal/add-food', [MealController::class, 'addFood'])->name('meal.addFood');
    Route::get('/meal/ai', [MealController::class, 'ai'])->name('meal.ai');
    Route::post('/meal/airesult', [MealController::class, 'recommendMeals'])->name('meal.airesult');
    Route::get('/meal/calculator', [MealController::class, 'calculator'])->name('calculator.calculator');
    Route::post('/meal/calculator-result', [MealController::class, 'calculateCalories'])->name('meal.calculateCalories');
    Route::post('/meals-by-date', [MealController::class, 'getMealsByDate'])->name('meal.getMealsByDate');
    Route::post('/get-calorie-data', [MealController::class, 'getCalorieData'])->name('meal.getCalorieData');
    Route::post('/meals/deletedetail', [MealController::class, 'deleteMealDetail'])->name('meal.delete');
});

// Route::middleware('auth')->group(function () {
//     Route::get('/meal', [MealController::class, 'meal'])->name('meal.index');
// });

require __DIR__.'/auth.php';
