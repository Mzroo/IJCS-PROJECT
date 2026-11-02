<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceTicket;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ReportController extends Controller
{
    /**
     * Menampilkan rekap laporan transaksi & keuangan servis.
     */
    public function index(Request $request): View
    {
        $startDate =$request->input('start_date', now()->startOfMonth()->toDateString());
        $endDate   =$request->input('end_date', now()->endOfMonth()->toDateString());

        // Filter tiket servis berdasarkan rentang tanggal
        $query = ServiceTicket::with(['customer', 'technician', 'creator'])
            ->whereDate('created_at', '>=', $startDate)
            ->whereDate('created_at', '<=', $endDate);

        $services = (clone $query)->latest()->paginate(15)->appends($request->all());

        // Calculation Statistik Laporan
        $totalTickets    = (clone$query)->count();
        $completedCount  = (clone$query)->where('status', 'taken')->count();
        $totalServiceFee = (clone$query)->where('payment_status', 'paid')->sum('service_fee');
        $totalSparepart  = (clone$query)->where('payment_status', 'paid')->sum('sparepart_fee');
        $totalOmset      = (clone$query)->where('payment_status', 'paid')->sum('total_amount');

        return view('admin.reports.index', compact(
            'services',
            'startDate',
            'endDate',
            'totalTickets',
            'completedCount',
            'totalServiceFee',
            'totalSparepart',
            'totalOmset'
        ));
    }

    /**
     * Tampilan cetak / cetak PDF laporan keuangan.
     */
    public function print(Request $request): View
    {
        $startDate = $request->input('start_date', now()->startOfMonth()->toDateString());
        $endDate   = $request->input('end_date', now()->endOfMonth()->toDateString());

        $query = ServiceTicket::with(['customer', 'technician', 'creator'])
            ->whereDate('created_at', '>=', $startDate)
            ->whereDate('created_at', '<=', $endDate);

        $services = (clone $query)->latest()->get();

        $totalTickets    = (clone $query)->count();
        $completedCount  = (clone $query)->where('status', 'taken')->count();
        $totalServiceFee = (clone $query)->where('payment_status', 'paid')->sum('service_fee');
        $totalSparepart  = (clone $query)->where('payment_status', 'paid')->sum('sparepart_fee');
        $totalOmset      = (clone $query)->where('payment_status', 'paid')->sum('total_amount');

        return view('admin.reports.print', compact(
            'services',
            'startDate',
            'endDate',
            'totalTickets',
            'completedCount',
            'totalServiceFee',
            'totalSparepart',
            'totalOmset'
        ));
    }
}