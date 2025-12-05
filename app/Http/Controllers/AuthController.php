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
        // Cek hanya guard 'web' (admin)
        if (Auth::guard('web')->check()) {
            return redirect()->route('admin.dashboard');
        }
        
        return view('auth.login-admin');
    }

    /**
     * Tampilkan form login kaban
     */
    public function showKabanLogin()
    {
        // Cek hanya guard 'kaban'
        if (Auth::guard('kaban')->check()) {
            return redirect()->route('kaban.dashboard');
        }
        
        return view('auth.login-kaban');
    }

    /**
     * Proses login ADMIN
     */
    public function adminLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6',
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

        // Login menggunakan guard 'web' (admin)
        if (Auth::guard('web')->attempt($credentials, $remember)) {
            $user = Auth::guard('web')->user();
            
            // Validasi: Pastikan user adalah ADMIN
            if ($user->role !== 'admin') {
                Auth::guard('web')->logout();
                return redirect()->back()
                    ->with('error', 'Akun Anda bukan Administrator. Silakan gunakan portal yang sesuai.')
                    ->withInput($request->only('email'));
            }

            $request->session()->regenerate();
            return redirect()->route('admin.dashboard');  
        }

        return redirect()->back()
            ->with('error', 'Email atau password salah.')
            ->withInput($request->only('email'));
    }

    /**
     * Proses login KABAN
     */
    public function kabanLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6',
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

        // Login menggunakan guard 'kaban'
        if (Auth::guard('kaban')->attempt($credentials, $remember)) {
            $user = Auth::guard('kaban')->user();
            
            // Validasi: Pastikan user adalah KABAN
            if ($user->role !== 'kaban') {
                Auth::guard('kaban')->logout();
                return redirect()->back()
                    ->with('error', 'Akun Anda bukan Pimpinan. Silakan gunakan portal yang sesuai.')
                    ->withInput($request->only('email'));
            }

            $request->session()->regenerate();
            return redirect()->route('kaban.dashboard');
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
        // Deteksi guard mana yang sedang logout
        if (Auth::guard('web')->check()) {
            Auth::guard('web')->logout();
            $redirectRoute = 'admin.login';
        } elseif (Auth::guard('kaban')->check()) {
            Auth::guard('kaban')->logout();
            $redirectRoute = 'kaban.login';
        } else {
            $redirectRoute = 'welcome';
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route($redirectRoute)
            ->with('success', 'Anda berhasil logout.');
    }
}