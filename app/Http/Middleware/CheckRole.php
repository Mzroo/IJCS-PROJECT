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
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (! Auth::check()) {
            return redirect('/login');
        }

        $user = Auth::user();

        // Cek apakah akun aktif
        if (! $user->is_active) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect('/login')->withErrors([
                'email' => 'Akun Anda telah dinonaktifkan. Silakan hubungi Owner.',
            ]);
        }

        // Konversi semua role ke huruf kecil untuk menghindari beda kapitalisasi
        $userRole = strtolower($user->role);
        $allowedRoles = array_map('strtolower', $roles);

        // Cek apakah role user sesuai dengan role yang diizinkan
        if (! in_array($userRole, $allowedRoles)) {
            abort(403, 'Anda tidak memiliki hak akses ke halaman ini.');
        }

        return $next($request);
    }
}