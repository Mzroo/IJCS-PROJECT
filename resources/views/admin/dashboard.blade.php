@extends('layouts.admin')

@section('title', 'Dashboard Overview')

@section('content')
<div class="space-y-6">

    <!-- HEADER / UCAPAN SELAMAT DATANG -->
    <div class="bg-gradient-to-r from-sky-600 to-blue-700 p-6 sm:p-8 rounded-3xl text-white shadow-xl shadow-sky-600/10 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-xl sm:text-2xl font-black tracking-tight">Selamat Datang, {{ auth()->user()->name }}!</h1>
            <p class="text-xs sm:text-sm text-sky-100 mt-1">Sistem Manajemen Servis Laptop & Komputer — <strong>Indra Jaya Computer</strong></p>
        </div>
        <a href="{{ route('services.create') }}" class="px-4 py-2.5 bg-white hover:bg-sky-50 text-sky-700 text-xs font-bold rounded-2xl shadow-md transition flex items-center gap-2 cursor-pointer">
            <i class="fa-solid fa-plus-circle text-sky-600"></i>
            <span>Terima Servis Baru</span>
        </a>
    </div>

    <!-- GRID STATISTIK CARD -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
        
        <!-- CARD 1: ANTREAN AKTIF -->
        <div class="bg-white p-5 rounded-3xl border border-slate-200/80 shadow-xs flex items-center justify-between">
            <div>
                <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block">Servis Aktif</span>
                <span class="text-2xl font-black text-slate-900 mt-0.5 block">{{ number_format($totalActive) }}</span>
                <span class="text-[10px] text-amber-600 font-bold mt-1 inline-block">Sedang Diproses</span>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-amber-50 border border-amber-200/60 flex items-center justify-center text-amber-600 text-lg">
                <i class="fa-solid fa-screwdriver-wrench"></i>
            </div>
        </div>

        <!-- CARD 2: SIAP DIAMBIL -->
        <div class="bg-white p-5 rounded-3xl border border-slate-200/80 shadow-xs flex items-center justify-between">
            <div>
                <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block">Siap Diambil</span>
                <span class="text-2xl font-black text-slate-900 mt-0.5 block">{{ number_format($totalCompleted) }}</span>
                <span class="text-[10px] text-emerald-600 font-bold mt-1 inline-block">Selesai Dikerjakan</span>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-emerald-50 border border-emerald-200/60 flex items-center justify-center text-emerald-600 text-lg">
                <i class="fa-solid fa-circle-check"></i>
            </div>
        </div>

        <!-- CARD 3: DIAMBIL HARI INI -->
        <div class="bg-white p-5 rounded-3xl border border-slate-200/80 shadow-xs flex items-center justify-between">
            <div>
                <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block">Diambil Hari Ini</span>
                <span class="text-2xl font-black text-slate-900 mt-0.5 block">{{ number_format($totalTakenToday) }}</span>
                <span class="text-[10px] text-sky-600 font-bold mt-1 inline-block">Unit Diserahkan</span>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-sky-50 border border-sky-200/60 flex items-center justify-center text-sky-600 text-lg">
                <i class="fa-solid fa-box-open"></i>
            </div>
        </div>

        <!-- CARD 4: PENDAPATAN HARI INI -->
        <div class="bg-white p-5 rounded-3xl border border-slate-200/80 shadow-xs flex items-center justify-between">
            <div>
                <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block">Pendapatan Hari Ini</span>
                <span class="text-xl font-black text-emerald-600 mt-0.5 block">Rp {{ number_format($incomeToday, 0, ',', '.') }}</span>
                <span class="text-[10px] text-slate-400 font-bold mt-1 inline-block">Kasir & Pelunasan</span>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-slate-900 flex items-center justify-center text-emerald-400 text-lg shadow-md shadow-slate-900/20">
                <i class="fa-solid fa-wallet"></i>
            </div>
        </div>

    </div>

    <!-- TABEL ANTREAN SERVIS TERBARU -->
    <div class="bg-white rounded-3xl border border-slate-200/80 shadow-xs overflow-hidden space-y-4 p-6">
        <div class="flex items-center justify-between border-b border-slate-100 pb-4">
            <h2 class="text-sm font-bold text-slate-900 flex items-center gap-2">
                <i class="fa-solid fa-clock-rotate-left text-sky-600"></i>
                <span>Antrean Servis Terbaru</span>
            </h2>
            <a href="{{ route('services.index') }}" class="text-xs font-bold text-sky-600 hover:text-sky-700 transition flex items-center gap-1">
                <span>Lihat Semua</span>
                <i class="fa-solid fa-chevron-right text-[10px]"></i>
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-slate-100 text-[10px] font-bold uppercase tracking-wider text-slate-400 bg-slate-50/50">
                        <th class="py-3 px-4 rounded-l-xl">No. Tiket</th>
                        <th class="py-3 px-4">Pelanggan</th>
                        <th class="py-3 px-4">Perangkat</th>
                        <th class="py-3 px-4">Status</th>
                        <th class="py-3 px-4 text-right rounded-r-xl">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-xs">
                    @forelse ($recentServices as $service)
                        <tr class="hover:bg-slate-50/80 transition">
                            <td class="py-3.5 px-4 font-mono font-bold text-sky-600">
                                {{ $service->ticket_number }}
                            </td>
                            <td class="py-3.5 px-4 font-bold text-slate-800">
                                {{ $service->customer->name }}
                            </td>
                            <td class="py-3.5 px-4 font-medium text-slate-700">
                                {{ $service->device_name }}
                            </td>
                            <td class="py-3.5 px-4">
                                @php
                                    $badges = [
                                        'received'          => 'bg-sky-50 text-sky-700 border-sky-200',
                                        'checking'          => 'bg-amber-50 text-amber-700 border-amber-200',
                                        'working'           => 'bg-indigo-50 text-indigo-700 border-indigo-200',
                                        'pending_sparepart' => 'bg-orange-50 text-orange-700 border-orange-200',
                                        'completed'         => 'bg-emerald-50 text-emerald-700 border-emerald-200',
                                        'taken'             => 'bg-slate-100 text-slate-700 border-slate-200',
                                        'cancelled'         => 'bg-rose-50 text-rose-700 border-rose-200',
                                    ];
                                @endphp
                                <span class="px-2.5 py-1 border rounded-lg text-[10px] font-bold uppercase tracking-wider {{ $badges[$service->status] ?? 'bg-slate-100 text-slate-700' }}">
                                    {{ str_replace('_', ' ', $service->status) }}
                                </span>
                            </td>
                            <td class="py-3.5 px-4 text-right">
                                <a href="{{ route('services.show', $service->id) }}" class="px-3 py-1.5 bg-slate-100 hover:bg-slate-200 text-slate-700 text-[11px] font-bold rounded-xl transition inline-flex items-center gap-1">
                                    <i class="fa-solid fa-eye text-slate-500"></i>
                                    <span>Detail</span>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-6 text-center text-slate-400 text-xs">Belum ada transaksi servis.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection