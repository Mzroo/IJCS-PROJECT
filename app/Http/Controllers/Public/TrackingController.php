<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\ServiceTicket;
use Illuminate\Http\JsonResponse;
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
     * Dilengkapi Rate Limiting (Maksimal 5x percobaan per menit per IP) & Support Modal AJAX.
     */
    public function search(Request $request): RedirectResponse|JsonResponse
    {
        // 1. RATE LIMITING: Buat key unik berdasarkan IP Pengguna
        $executedKey = 'search-ticket:' . $request->ip();

        // Cek apakah IP sudah melebihi batas (5 kali per 60 detik)
        if (RateLimiter::tooManyAttempts($executedKey, 5)) {
            $seconds = RateLimiter::availableIn($executedKey);
            $message = 'Terlalu banyak percobaan pencarian. Silakan coba lagi dalam ' . $seconds . ' detik.';

            if ($request->ajax()) {
                return response()->json([
                    'status'  => 'error',
                    'message' => $message,
                ], 429);
            }

            return redirect()->back()->withErrors([
                'ticket_number' => $message
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

        // 4. CARI TIKET DI DATABASE BERSAMA RELASINYA
        $service = ServiceTicket::with([
            'customer', 
            'technician', 
            'detail', 
            'statusHistories.user'
        ])->where('ticket_number', $ticketNumber)->first();

        if (!$service) {
            $errorMessage = 'Nomor tiket servis "' . $ticketNumber . '" tidak ditemukan. Mohon periksa kembali nomor tiket pada nota Anda.';

            if ($request->ajax()) {
                return response()->json([
                    'status'  => 'error',
                    'message' => $errorMessage,
                ], 404);
            }

            return redirect()->back()->withErrors([
                'ticket_number' => $errorMessage
            ])->withInput();
        }

        // 5. JIKA DITEMUKAN: Clear hit rate-limiter
        RateLimiter::clear($executedKey);

        // RESPONS KHUSUS MODAL POP-UP AJAX
        if ($request->ajax()) {
            $html = view('public.partials.track-modal', compact('service'))->render();
            return response()->json([
                'status' => 'success',
                'html'   => $html,
            ]);
        }

        // FALLBACK REDIRECT REGULER (NON-AJAX)
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