<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\ServiceTicket;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\View\View;

class TrackingController extends Controller
{
    /**
     * Halaman Utama Publik (Landing Page Toko & Search Bar Tracking).
     */
    public function home(): View
    {
        return view('public.home');
    }

    /**
     * Memproses pencarian manual berdasarkan Nomor Tiket dari form landing page.
     * Dilengkapi Rate Limiting (Maksimal 5x percobaan per menit per IP).
     */
    public function search(Request $request): RedirectResponse
    {
        // 1. RATE LIMITING: Buat key unik berdasarkan IP Pengguna
        $executedKey = 'search-ticket:' . $request->ip();

        // Cek apakah IP sudah melebihi batas (5 kali per 60 detik)
        if (RateLimiter::tooManyAttempts($executedKey, 5)) {
            $seconds = RateLimiter::availableIn($executedKey);
            
            return redirect()->back()->withErrors([
                'ticket_number' => 'Terlalu banyak percobaan pencarian. Silakan coba lagi dalam ' . $seconds . ' detik.'
            ])->withInput();
        }

        // 2. VALIDASI INPUT
        $request->validate([
            'ticket_number' => 'required|string',
        ]);

        // Catat percobaan (Hit RateLimiter)
        RateLimiter::hit($executedKey, 60);

        // 3. PEMBERSIHAN STRING (Trim & Upper)
        $ticketNumber = strtoupper(trim($request->ticket_number));

        // 4. CARI TIKET DI DATABASE
        $service = ServiceTicket::where('ticket_number', $ticketNumber)->first();

        if (!$service) {
            return redirect()->back()->withErrors([
                'ticket_number' => 'Nomor tiket servis "' . $ticketNumber . '" tidak ditemukan. Mohon periksa kembali nomor tiket pada nota Anda.'
            ])->withInput();
        }

        // 5. JIKA DITEMUKAN: Clear hit rate-limiter dan redirect ke URL tracking publik
        RateLimiter::clear($executedKey);
        return redirect()->route('public.track', $service->tracking_token);
    }

    /**
     * Tampilkan halaman pelacakan publik berdasarkan tracking_token.
     */
    public function track(string $token): View
    {
        $service = ServiceTicket::with([
            'customer', 
            'technician', 
            'detail', 
            'statusHistories.user'
        ])->where('tracking_token', $token)->firstOrFail();

        return view('public.track', compact('service'));
    }
}