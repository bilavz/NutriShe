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
                ],
                'token' => $userData['token'], // Misalkan token disimpan juga untuk keperluan autentikasi berikutnya
            ]);

            // Redirect ke halaman dashboard setelah login berhasil
            return redirect()->route('dashboard');
        } else {
            // Handle error jika kredensial tidak valid
            Log::error('Failed to login user:', ['error' => $response->body()]);
            return back()->withErrors(['message' => 'Invalid credentials']);
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
