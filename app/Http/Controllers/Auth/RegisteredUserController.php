<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        Log::info('Starting user registration process...');

        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'birthdate' => ['required', 'date'],
            'height' => ['required', 'numeric'],
            'weight' => ['required', 'numeric'],
        ]);

        // Prepare data to be sent to Go server
        $data = [
            'username' => $request->username,  // Assuming you have 'username' in your request
            'email' => $validatedData['email'],
            'password' => $validatedData['password'],
            'name' => $validatedData['name'],
            'birthdate' => $validatedData['birthdate'],
            'height' => (float) $validatedData['height'],
            'weight' => (float) $validatedData['weight'],
        ];

        // Send POST request to Go server
        $goServerUrl = env('GO_SERVER_URL');
        try {
            Log::info('Sending POST request to Golang server...');
            $response = Http::post($goServerUrl . '/register', $data);

            if ($response->successful()) {
                // Registration successful
                Log::info('User registered successfully:', ['response' => $response->body()]);

                return redirect()->route('login');
            } else {
                // Registration failed
                Log::error('Failed to register user:', ['error' => $response->body()]);

                $error = $response->body();
                return redirect()->back()->with('error_message', 'Failed to register user: ' . $error);
            }
        } catch (\Exception $e) {
            // Handle exceptions if any
            Log::error('Exception occurred:', ['message' => $e->getMessage()]);

            return redirect()->back()->with('error_message', 'Failed to connect to registration service');
        }
    }
}
