<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class MealController extends Controller
{
    public function index(Request $request)
    {
        $goServerUrl = env('GO_SERVER_URL');

        // Fetch meal data from your backend API or database
        $response = Http::get($goServerUrl . '/food');

        // Check if API request was successful
        if ($response->successful()) {
            $foodsByType = $response->json();
        } else {
            $error = $response->status();
            return redirect()->back()->with('error', 'Failed to fetch meal data. Please try again later.');
        }

        $user = $request->session()->get('user');
        $filterType = $request->input('filterType', 'all'); // Default to 'all' or get from request

        return view('meal.index', compact('user', 'foodsByType', 'filterType'));
    }

    public function calculator(Request $request)
    {
        $user = $request->session()->get('user');

        return view('calculator.calculator', compact('user'));
    }
    

    public function logMeal(Request $request)
    {
        $goServerUrl = env('GO_SERVER_URL');
        // Log::debug('Data in controller');
        $request->validate([
            'food_id' => 'required|string',
            'meal_date' => 'required|date_format:Y-m-d',
        ]);

        Log::debug('Data validated');
        // Get user ID from session or request
        $user_id = $request->session()->get('user')['user_id']; // Assuming user ID is stored in session
        Log::debug('User ID from session:', ['user_id' => $user_id]);

        // Prepare data to send to Golang server
        $data = [
            'food_id' => $request->input('food_id'),
            'meal_date' => $request->input('meal_date'),
            'user_id' => $user_id,
        ];

        Log::debug('Data to send to Golang server:', $data);
        // Send HTTP POST request to Golang server
        try {
            $response = Http::post($goServerUrl . '/dailymeal', $data);
            Log::debug('Response from Golang server:', ['status' => $response->status(), 'body' => $response->json()]);

            if ($response->successful() && $response['message'] === 'Meal logged successfully') {
                return redirect()->back()->with('success', 'Meal logged successfully!');
            } else {
                return redirect()->back()->with('error', 'Failed to log meal. Please try again later.');
            }
        } catch (\Exception $e) {
            Log::error('Failed to connect to Golang server:', ['exception' => $e]);
            return redirect()->back()->with('error', 'Failed to connect to server. Please try again later.');
        }
    }

    public function getMealsByDate(Request $request)
    {
        $goServerUrl = env('GO_SERVER_URL');
        // Log::debug('Data in controller');

        try {
            // Validasi input
            $request->validate([
                'meal_date' => 'required|date_format:Y-m-d',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation failed:', ['errors' => $e->errors()]);
            return redirect()->back()->withErrors($e->errors())->withInput();
        }

        Log::debug('Data validated');

        // Mendapatkan user ID dari sesi
        $user_id = $request->session()->get('user')['user_id'];
        Log::debug('User ID from session:', ['user_id' => $user_id]);

        // Menyiapkan data untuk dikirim ke server Golang
        $data = [
            'user_id' => $user_id,
            'meal_date' => $request->input('meal_date'),
        ];

        Log::debug('Data to send to Golang server:', $data);

        // Mengirim permintaan POST HTTP ke server Golang
        try {
            $response = Http::post($goServerUrl . '/mealdetail', $data);
            Log::debug('Response from Golang server:', ['status' => $response->status(), 'body' => $response->json()]);
            
            // Memeriksa keberhasilan respons dari server Golang
            if ($response->successful()) {
                $mealsData = $response->json();

                // Memeriksa apakah ada data makanan yang diterima
                if (isset($mealsData['meals']) && is_array($mealsData['meals'])) {
                    $meals = $mealsData['meals'];
                } else {
                    $meals = [];
                }

                // Memeriksa total kalori
                $totalCalories = isset($mealsData['total_calories']) ? $mealsData['total_calories'] : 0;

                return response()->json(['meals' => $meals, 'totalCalories' => $totalCalories]);
            } else {
                return response()->json(['error' => 'Failed to fetch meals. Please try again later.'], $response->status());
            }
        } catch (\Exception $e) {
            Log::error('Failed to connect to Golang server:', ['exception' => $e]);
            return redirect()->back()->with('error', 'Failed to connect to server. Please try again later.');
        }
    }

    public function addFood(Request $request)
    {
        $goServerUrl = env('GO_SERVER_URL');

        // Log sebelum validasi
        Log::debug('Before validation');
        try {
            // Validasi input dari request
            $request->validate([
                'name' => 'required|string',
                'serving' => 'required|integer|min:1',
                'calories' => 'required|integer|min:0',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Log jika validasi gagal
            Log::error('Validation failed:', ['errors' => $e->errors()]);
            return redirect()->back()->withErrors($e->errors())->withInput();
        }

        $serving = intval($request->input('serving'));
        $calories = intval($request->input('calories'));
        
        // Log setelah validasi berhasil
        Log::debug('Validation successful');
        Log::debug('Before sending data to Golang server');
        
        // Data yang akan dikirimkan ke server Golang
        $data = [
            'name' => $request->input('name'),
            'serving' => $serving,
            'calories' => $calories,
        ];

        Log::debug('Data to send to Golang server:', $data);
        Log::debug('After sending data to Golang server');

        // Kirim permintaan HTTP POST ke server Golang
        try {
            $response = Http::post($goServerUrl . '/add_meal', $data);
            Log::debug('Response from Golang server:', ['status' => $response->status(), 'body' => $response->json()]);
            
            // Memeriksa keberhasilan respons dari server Golang
            if ($response->successful()) {
                // Redirect hanya jika data berhasil ditambahkan
                return redirect()->back()->with('success', 'Food added successfully!');
            } else {
                return redirect()->back()->with('error', 'Failed to add food. Please try again later.');
            }
        } catch (\Exception $e) {
            Log::error('Failed to connect to Golang server:', ['exception' => $e]);
            return redirect()->back()->with('error', 'Failed to connect to server. Please try again later.');
        }
    }



}
