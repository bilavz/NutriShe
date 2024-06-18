<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MealController;
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
    return view('auth.register');
});
Route::get('/meal', function () {
    return view('meal.index');
});

Route::get('/login', function () {
    return view('auth.login');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/planner', function () {
    return view('mealplan.index');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route::middleware('auth')->group(function () {
//     Route::get('/meal', [MealController::class, 'meal'])->name('meal.index');
// });

require __DIR__.'/auth.php';
