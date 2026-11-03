<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LoginController extends Controller
{
    public function showLoginForm(): View
    {
        // Generate Captcha 4 Karakter
        $captchaCode = strtoupper(substr(str_shuffle('ABCDEFGHJKLMNPQRSTUVWXYZ23456789'), 0, 4));
        session(['captcha_code' => $captchaCode]);

        return view('auth.login', compact('captchaCode'));
    }

    public function login(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Check 1: Verifikasi status keaktifan akun staf
        if (!$user->is_active) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('login')->withErrors([
                'email' => 'Akun Anda telah dinonaktifkan oleh Administrator. Silakan hubungi Owner toko.'
            ]);
        }

        // Check 2: Regenerasi ID sesi untuk mencegah Session Fixation Attack
        $request->session()->regenerate();

        // Check 3: Pengalihan berdasarkan Hak Akses / Role
        if (in_array($user->role, ['owner', 'admin'])) {
            return redirect()->intended('/admin/dashboard');
        }

        return redirect()->intended('/admin/services');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('public.home')->with('status', 'Anda telah berhasil keluar dari sistem.');
    }
}