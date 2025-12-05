<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // Tentukan guard berdasarkan role
        $guard = $this->getGuardByRole($role);

        // Cek apakah user sudah login dengan guard yang tepat
        if (!Auth::guard($guard)->check()) {
            return redirect()->route($role . '.login')
                ->with('error', 'Silakan login terlebih dahulu.');
        }

        // Cek apakah role user sesuai
        $user = Auth::guard($guard)->user();
        
        if ($user->role !== $role) {
            // Redirect ke dashboard sesuai role mereka
            $userRole = $user->role;
            return redirect()->route($userRole . '.dashboard')
                ->with('error', 'Anda tidak memiliki akses ke halaman tersebut.');
        }

        return $next($request);
    }

    /**
     * Tentukan guard berdasarkan role
     */
    private function getGuardByRole(string $role): string
    {
        return match($role) {
            'admin' => 'web',
            'kaban' => 'kaban',
            default => 'web',
        };
    }
}