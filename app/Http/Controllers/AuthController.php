<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Tampilkan form login admin
     */
    public function showAdminLogin()
    {
        // Jika sudah login, redirect ke dashboard masing-masing
        if (Auth::check()) {
            return $this->redirectToDashboard();
        }
        
        return view('auth.login-admin');
    }

    /**
     * Tampilkan form login kaban
     */
    public function showKabanLogin()
    {
        // Jika sudah login, redirect ke dashboard masing-masing
        if (Auth::check()) {
            return $this->redirectToDashboard();
        }
        
        return view('auth.login-kaban');
    }

    /**
     * Proses login
     */
    public function login(Request $request)
{
    $validator = Validator::make($request->all(), [
        'email' => 'required|email',
        'password' => 'required|min:6',
        'role' => 'required|in:admin,kaban'
    ]);

    if ($validator->fails()) {
        return redirect()->back()
            ->withErrors($validator)
            ->withInput();
    }

    $credentials = [
        'email' => $request->email,
        'password' => $request->password,
    ];

    $remember = $request->has('remember');

    if (Auth::attempt($credentials, $remember)) {
        $request->session()->regenerate();

        $user = Auth::user();
        
        if ($user->role !== $request->role) {
            Auth::logout();
            return redirect()->back()
                ->with('error', 'Anda tidak memiliki akses ke portal ini.')
                ->withInput($request->only('email'));
        }

        return $this->redirectToDashboard();
    }

    return redirect()->back()
        ->with('error', 'Email atau password salah.')
        ->withInput($request->only('email'));
}

    /**
     * Proses logout
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('welcome')
            ->with('success', 'Anda berhasil logout.');
    }

    /**
     * Redirect ke dashboard sesuai role
     */
    private function redirectToDashboard()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            return redirect()->route('dashboard');
        } elseif ($user->role === 'kaban') {
            return redirect()->route('kaban.dashboard');
        }

        // Fallback jika role tidak dikenali
        Auth::logout();
        return redirect()->route('welcome')
            ->with('error', 'Role tidak valid.');
    }
}