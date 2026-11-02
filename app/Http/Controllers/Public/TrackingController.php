<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\ServiceTicket;
use Illuminate\View\View;

class TrackingController extends Controller
{
    /**
     * Menampilkan halaman tracking publik servis berdasarkan token unik.
     */
    public function show(string $token): View
    {
        // Cari tiket berdasarkan tracking_token unik
        $service = ServiceTicket::with([
            'customer',
            'technician',
            'statusHistories.user',
            'spareparts.product'
        ])->where('tracking_token', $token)->firstOrFail();

        return view('public.track', compact('service'));
    }
}