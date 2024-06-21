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
    public function ai(Request $request)
    {
        $user = $request->session()->get('user');

        return view('meal.ai', compact('user'));
    }

    public function search(Request $request)
    {
        $user = $request->session()->get('user');

        return view('search', compact('user'));
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

    public function getCalorieData(Request $request)
    {
        Log::debug('Calorie Data COntrollers');
        $goServerUrl = env('GO_SERVER_URL');

        try {
            // Get user_id from session
            $user_id = $request->session()->get('user')['user_id'];
            Log::debug('User ID from session:', ['user_id' => $user_id]);

            // Make POST request to Golang server
            $response = Http::post($goServerUrl . '/calories_goal', [
                'user_id' => $user_id,
            ]);

            Log::debug('Response from Golang server:', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);

            // Check if the request was successful
            if ($response->successful()) {
                $calorieData = $response->body();
                return response()->json($calorieData);
            } else {
                return response()->json(['error' => 'Failed to fetch calorie data.'], $response->status());
            }
        } catch (\Exception $e) {
            Log::error('Exception while connecting to Golang server:', ['exception' => $e]);
            return response()->json(['error' => 'Failed to connect to server.'], 500);
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

    public function calculateCalories(Request $request)
    {
        $goServerUrl = env('GO_SERVER_URL');

        // Validate request data
        // $request->validate([
        //     'age' => 'required|integer|min:1',
        //     'height' => 'required|numeric|min:1',
        //     'weight' => 'required|numeric|min:1',
        //     'activity' => 'required|string',
        // ]);

        try {
            // Validasi input
            $request->validate([
                'age' => 'required|integer|min:1',
                'height' => 'required|numeric|min:1',
                'weight' => 'required|numeric|min:1',
                'activity' => 'required|string',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation failed:', ['errors' => $e->errors()]);
            return redirect()->back()->withErrors($e->errors())->withInput();
        }

        $user_id = $request->session()->get('user')['user_id'];
        Log::debug('User ID from session:', ['user_id' => $user_id]);

        // Prepare data to send to Go server
        $data = [
            'user_id' => $user_id,
            'age' => (int)$request->input('age'),
            'height' => (float)$request->input('height'),
            'weight' => (float)$request->input('weight'),
            'activity' => $request->input('activity'),
        ];

        Log::debug('Data to send to Golang server:', $data);

        try {
            // Send HTTP POST request to Go server for calorie calculation
            $response = Http::post($goServerUrl . '/calculate', $data);

            // Check if request was successful
            if ($response->successful()) {
                $calorieData = $response->json();

                // Assuming the Go server responds with a 'calories' key in JSON
                $calories = $calorieData['calories'];

                // Optionally log the response
                Log::info('Calculated calories:', ['calories' => $calories]);

                return response()->json(['calories' => $calories]);
            } else {
                return response()->json(['error' => 'Failed to calculate calories. Please try again later.'], $response->status());
            }
        } catch (\Exception $e) {
            Log::error('Failed to connect to Go server:', ['exception' => $e]);
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

    public function recommendMeals(Request $request)
    {
        // Ambil URL server Golang dari environment variable
        $goServerUrl = env('GO_SERVER_URL');
        Log::debug('Before validation');
        // Validasi input jika diperlukan
        // $request->validate([
        //     'days' => 'required|integer|min:1',
        //     'calories' => 'required|integer|min:1',
        //     'cuisine' => 'required|string',
        // ]);
        try {
            // Validasi input dari request
            $request->validate([
                'days' => 'required|integer|min:1',
                'calories' => 'required|integer|min:1',
                'cuisine' => 'required|string',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Log jika validasi gagal
            Log::error('Validation failed:', ['errors' => $e->errors()]);
            return redirect()->back()->withErrors($e->errors())->withInput();
        }

        // Data yang akan dikirim ke server Golang
        $data = [
            'Days' => $request->input('days'),
            'Calories' => $request->input('calories'),
            'Cuisine' => $request->input('cuisine'),
        ];

        try {
            // Kirim permintaan POST HTTP ke server Golang
            $response = Http::post($goServerUrl . '/recommend_meals', $data);
            Log::debug('Response from Golang server:', ['status' => $response->status(), 'body' => $response->json()]);

            if ($response->successful()) {
                $aiResponse = $response->json();
                // Mengembalikan tampilan dengan membawa data hasil respons
                return view('meal.ai', ['aiResponse' => $aiResponse]);
            } else {
                return response()->json(['error' => 'Failed to recommend meals. Please try again later.'], $response->status());
            }
        } catch (\Exception $e) {
            Log::error('Failed to connect to Golang server:', ['exception' => $e]);
            return response()->json(['error' => 'Failed to connect to server. Please try again later.'], 500);
        }
    }

    public function searchArticles(Request $request)
    {
        $goServerUrl = env('GO_SERVER_URL');

        try {
            // Validasi input dari request
            $request->validate([
                'query' => 'required|string',

            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Log jika validasi gagal
            Log::error('Validation failed:', ['errors' => $e->errors()]);
            return redirect()->back()->withErrors($e->errors())->withInput();
        }

        // Log::debug('Search query:', ['query' => $searchQuery]);

        // Data yang akan dikirim ke server Go
        $data = [
            'Query' => $request->input('query'),
        ];

        try {
            // Kirim permintaan HTTP POST ke server Go
            $response = Http::post($goServerUrl . '/search_articles', $data);
            Log::debug('Response from Golang server:', ['status' => $response->status(), 'body' => $response->json()]);

            if ($response->successful()) {
                $searchResults = $response->json();
                // Mengembalikan tampilan dengan membawa hasil pencarian
                return view('search', ['articles' => $searchResults]);
            } else {
                return redirect()->back()->with('error', 'Failed to search articles. Please try again later.');
            }
        } catch (\Exception $e) {
            Log::error('Failed to connect to Golang server:', ['exception' => $e]);
            return redirect()->back()->with('error', 'Failed to connect to server. Please try again later.');
        }
    }

    public function deleteMealDetail(Request $request)
    {
        $goServerUrl = env('GO_SERVER_URL');

        $request->validate([
            'food_id' => 'required|string',
            'meal_date' => 'required|date_format:Y-m-d',
        ]);

        // Get user ID from session
        $user_id = $request->session()->get('user')['user_id'];

        // Prepare data to send to Golang server
        $data = [
            'food_id' => $request->input('food_id'),
            'meal_date' => $request->input('meal_date'),
            'user_id' => $user_id,
        ];

        try {
            $response = Http::post($goServerUrl . '/deletemealdetail', $data);

            if ($response->successful() && $response['message'] === 'Meal detail deleted successfully') {
                return redirect()->back()->with('success', 'Meal detail deleted successfully!');
            } else {
                return redirect()->back()->with('error', 'Failed to delete meal detail. Please try again later.');
            }
        } catch (\Exception $e) {
            Log::error('Failed to connect to Golang server:', ['exception' => $e]);
            return redirect()->back()->with('error', 'Failed to connect to server. Please try again later.');
        }
    }

}
