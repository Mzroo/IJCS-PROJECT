<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Nantinya data statistik ini diambil dari database (Model)
        $stats = [
            'total_tiket'      => 12,
            'siap_diambil'     => 5,
            'total_sparepart'  => 540,
            'pendapatan_bulan' => 8450000,
        ];

        return view('admin.dashboard', compact('stats'));
    }
}