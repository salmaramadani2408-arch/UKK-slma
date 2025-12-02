<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // Cek apakah user sudah login
        if (!Auth::check()) {
            return redirect()->route('welcome')
                ->with('error', 'Silakan login terlebih dahulu.');
        }

        // Cek apakah role user sesuai
        if (Auth::user()->role !== $role) {
            // Jika tidak sesuai, redirect ke dashboard mereka
            if (Auth::user()->role === 'admin') {
                return redirect()->route('dashboard')
                    ->with('error', 'Anda tidak memiliki akses ke halaman tersebut.');
            } elseif (Auth::user()->role === 'kaban') {
                return redirect()->route('kaban.dashboard')
                    ->with('error', 'Anda tidak memiliki akses ke halaman tersebut.');
            }
            
            // Fallback logout jika role tidak dikenali
            Auth::logout();
            return redirect()->route('welcome')
                ->with('error', 'Role tidak valid.');
        }

        return $next($request);
    }
}