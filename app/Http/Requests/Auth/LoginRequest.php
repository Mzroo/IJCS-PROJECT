<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
            'captcha' => ['required', 'string', 'size:4'],
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Kata sandi wajib diisi.',
            'captcha.required' => 'Kode verifikasi keamanan wajib diisi.',
            'captcha.size' => 'Kode verifikasi harus 4 karakter.',
        ];
    }

    public function authenticate(): void
    {
        // 1. Cek Rate Limiter (Maksimal 5 kali batas coba)
        $this->ensureIsNotRateLimited();

        // 2. Validasi Captcha dengan Session
        if (strtoupper($this->input('captcha')) !== session('captcha_code')) {
            RateLimiter::hit($this->throttleKey());
            
            // Reset captcha baru saat gagal
            session(['captcha_code' => strtoupper(substr(str_shuffle('ABCDEFGHJKLMNPQRSTUVWXYZ23456789'), 0, 4))]);

            throw ValidationException::withMessages([
                'captcha' => 'Kode verifikasi keamanan (captcha) tidak sesuai.',
            ]);
        }

        // 3. Cek Kredensial Email & Password
        if (! Auth::attempt($this->only('email', 'password'), $this->boolean('remember'))) {
            RateLimiter::hit($this->throttleKey());

            session(['captcha_code' => strtoupper(substr(str_shuffle('ABCDEFGHJKLMNPQRSTUVWXYZ23456789'), 0, 4))]);

            throw ValidationException::withMessages([
                'email' => 'Kredensial email atau kata sandi tidak cocok.',
            ]);
        }

        // Hapus catatan percobaan gagal saat login sukses
        RateLimiter::clear($this->throttleKey());
    }

    public function ensureIsNotRateLimited(): void
    {
        // Batas coba diatur ke 5 kali (aman & tidak menyusahkan kasir)
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => "Terlalu banyak percobaan login gagal. Silakan tunggu {$seconds} detik.",
        ]);
    }

    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->input('email')).'|'.$this->ip());
    }
}