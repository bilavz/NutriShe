<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    // public function store(LoginRequest $request): RedirectResponse
    // {
    //     $request->authenticate();

    //     $request->session()->regenerate();

    //     return redirect()->intended(RouteServiceProvider::HOME);
    // }
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        try {
            // Kirim permintaan POST ke API Golang untuk login
            $goServerUrl = env('GO_SERVER_URL');
            $response = Http::post($goServerUrl . '/login', [
                'email' => $request->email,
                'password' => $request->password,
            ]);

            // Periksa keberhasilan permintaan dan dapatkan data pengguna serta token JWT
            if ($response->successful()) {
                $userData = $response->json(); // Ambil data pengguna dari respons JSON

                // Simpan data pengguna dan token dalam sesi atau cookie
                session([
                    'user' => [
                        'user_id' => $userData['user_id'],
                        'name' => $userData['name'],
                        'username' => $userData['username'],
                        'email' => $userData['email'],
                        'birthdate' => $userData['birthdate'],
                        'height' => $userData['height'],
                        'weight' => $userData['weight'],
                        'token' => $userData['token'], // Simpan token di sesi user
                    ],
                    'token' => $userData['token'], // Simpan token di sesi user
                ]);

                // Redirect ke halaman dashboard setelah login berhasil
                Log::info('User logged in successfully.', ['user_id' => $userData['user_id']]);
                return redirect()->route('welcome');
            } else {
                // Handle error jika kredensial tidak valid
                $error = $response->json()['error'] ?? 'Unknown error';
                Log::error('Failed to login user.', ['error' => $error]);
                return back()->withErrors(['message' => 'Invalid credentials']);
            }
        } catch (\Exception $e) {
            // Tangkap dan log exception
            Log::error('Exception occurred during login.', ['exception' => $e->getMessage()]);
            return back()->withErrors(['message' => 'Something went wrong. Please try again later.']);
        }
    }


    /**
     * Destroy an authenticated session.
     */
    // public function destroy(Request $request): RedirectResponse
    // {
    //     Auth::guard('web')->logout();

    //     $request->session()->invalidate();

    //     $request->session()->regenerateToken();

    //     return redirect('/');
    // }

    public function destroy(Request $request): RedirectResponse
    {
        Log::info('Starting logout process.');

        $user = session('user');
        $token = isset($user['token']) ? $user['token'] : null;
        Log::info('Token retrieved from session user data.', ['token' => $token]);

        // Check if token exists
        if (!$token) {
            Log::error('No token found in session. Redirecting to home.');
            return redirect('/');
        }

        // Send logout request to Golang server
        $goServerUrl = env('GO_SERVER_URL');
        Log::info('Golang server URL retrieved from env.', ['GO_SERVER_URL' => $goServerUrl]);

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
            ])->post($goServerUrl . '/logout');
            Log::info('Logout request sent to Golang server.', ['response_status' => $response->status()]);
        } catch (\Exception $e) {
            Log::error('Exception occurred while sending logout request to Golang server.', ['exception' => $e->getMessage()]);
        }

        // Log the response from the Golang server
        if ($response->successful()) {
            Log::info('Successfully logged out from Golang server.');
        } else {
            Log::error('Failed to logout from Golang server.', ['response_body' => $response->body(), 'response_status' => $response->status()]);
        }

        // Clear session data in Laravel
        Log::info('Invalidating session.');
        $request->session()->invalidate();

        Log::info('Regenerating session token.');
        $request->session()->regenerateToken();

        Log::info('Logout process completed. Redirecting to home.');
        return redirect('/');
    }
}
