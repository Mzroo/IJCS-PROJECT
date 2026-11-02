<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceTicket;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Menampilkan overview ringkasan statistik dashboard.
     */
    public function index(): View
    {
        // 1. Statistik Utama Tiket Servis
        $totalActive = ServiceTicket::whereIn('status', ['received', 'checking', 'working', 'pending_sparepart'])->count();
        $totalCompleted = ServiceTicket::where('status', 'completed')->count();
        $totalTakenToday = ServiceTicket::where('status', 'taken')
            ->whereDate('updated_at', now()->today())
            ->count();

        // 2. Total Pendapatan Kasir Hari Ini (Hanya transaksi yang sudah LUNAS/paid)
        $incomeToday = ServiceTicket::where('payment_status', 'paid')
            ->whereDate('updated_at', now()->today())
            ->sum('total_amount');

        // 3. Antrean Servis Terbaru (5 Tiket Terakhir)
        $recentServices = ServiceTicket::with(['customer', 'technician'])
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalActive',
            'totalCompleted',
            'totalTakenToday',
            'incomeToday',
            'recentServices'
        ));
    }
}