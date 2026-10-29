@extends('layouts.admin')

@section('content')
<div class="space-y-6">

    <!-- Welcome Banner -->
    <div class="relative overflow-hidden bg-gradient-to-r from-sky-600 to-blue-700 rounded-3xl p-5 sm:p-8 text-white shadow-lg shadow-sky-600/20">
        <div class="relative z-10">
            <h1 class="text-xl sm:text-2xl md:text-3xl font-black tracking-tight leading-snug">
                Selamat Datang, Admin IJCS! 👋
            </h1>
            <p class="text-sky-100 text-xs sm:text-sm mt-1.5 max-w-xl leading-relaxed">
                Pantau perkembangan tiket servis laptop, stok sparepart, dan rekapitulasi transaksi toko dalam satu panel terpadu.
            </p>
        </div>
        <i class="fa-solid fa-laptop-code absolute -right-4 -bottom-4 text-7xl sm:text-9xl text-white/10 pointer-events-none"></i>
    </div>

    <!-- Ringkasan Stat Cards: Mobile (grid-cols-2), Tablet (lg:grid-cols-2), Desktop Besar (xl:grid-cols-4) -->
    <div class="grid grid-cols-2 xl:grid-cols-4 gap-3 sm:gap-5">
        
        <!-- Card 1: Tiket Servis -->
        <div class="bg-white p-4 sm:p-5 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition flex flex-col justify-between">
            <div class="flex items-start justify-between gap-2">
                <div>
                    <p class="text-[10px] sm:text-xs font-semibold text-gray-500 uppercase tracking-wider">Tiket Servis</p>
                    <h3 class="text-lg sm:text-2xl font-black text-gray-900 mt-1">
                        {{ $stats['total_tiket'] }} <span class="text-[10px] sm:text-xs font-normal text-gray-400">Unit</span>
                    </h3>
                </div>
                <div class="w-8 h-8 sm:w-11 sm:h-11 rounded-xl bg-sky-50 text-sky-600 flex items-center justify-center text-sm sm:text-lg shrink-0">
                    <i class="fa-solid fa-ticket"></i>
                </div>
            </div>
        </div>

        <!-- Card 2: Siap Diambil -->
        <div class="bg-white p-4 sm:p-5 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition flex flex-col justify-between">
            <div class="flex items-start justify-between gap-2">
                <div>
                    <p class="text-[10px] sm:text-xs font-semibold text-gray-500 uppercase tracking-wider">Siap Diambil</p>
                    <h3 class="text-lg sm:text-2xl font-black text-emerald-600 mt-1">
                        {{ $stats['siap_diambil'] }} <span class="text-[10px] sm:text-xs font-normal text-gray-400">Unit</span>
                    </h3>
                </div>
                <div class="w-8 h-8 sm:w-11 sm:h-11 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-sm sm:text-lg shrink-0">
                    <i class="fa-solid fa-circle-check"></i>
                </div>
            </div>
        </div>

        <!-- Card 3: Stok Sparepart -->
        <div class="bg-white p-4 sm:p-5 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition flex flex-col justify-between">
            <div class="flex items-start justify-between gap-2">
                <div>
                    <p class="text-[10px] sm:text-xs font-semibold text-gray-500 uppercase tracking-wider">Stok Sparepart</p>
                    <h3 class="text-lg sm:text-2xl font-black text-gray-900 mt-1">
                        {{ $stats['total_sparepart'] }} <span class="text-[10px] sm:text-xs font-normal text-gray-400">Item</span>
                    </h3>
                </div>
                <div class="w-8 h-8 sm:w-11 sm:h-11 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center text-sm sm:text-lg shrink-0">
                    <i class="fa-solid fa-boxes-stacked"></i>
                </div>
            </div>
        </div>

        <!-- Card 4: Pendapatan -->
        <div class="bg-white p-4 sm:p-5 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition flex flex-col justify-between">
            <div class="flex items-start justify-between gap-2">
                <div>
                    <p class="text-[10px] sm:text-xs font-semibold text-gray-500 uppercase tracking-wider">Pendapatan</p>
                    <h3 class="text-base sm:text-xl font-black text-sky-600 mt-1">
                        Rp {{ number_format($stats['pendapatan_bulan'], 0, ',', '.') }}
                    </h3>
                </div>
                <div class="w-8 h-8 sm:w-11 sm:h-11 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center text-sm sm:text-lg shrink-0">
                    <i class="fa-solid fa-wallet"></i>
                </div>
            </div>
        </div>

    </div>

    <!-- Tabel Servis Terbaru (Responsif Scroll Horizontal di Mobile) -->
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="p-4 sm:p-5 border-b border-gray-100 flex items-center justify-between">
            <h3 class="font-bold text-gray-800 text-sm sm:text-base">Antrean Servis Terbaru</h3>
            <a href="#" class="text-xs font-semibold text-sky-600 hover:text-sky-700">Lihat Semua →</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse min-w-[500px]">
                <thead>
                    <tr class="bg-gray-50 text-gray-500 text-[10px] sm:text-[11px] font-bold uppercase tracking-wider">
                        <th class="p-3 sm:p-4">No. Tiket</th>
                        <th class="p-3 sm:p-4">Pelanggan</th>
                        <th class="p-3 sm:p-4">Perangkat</th>
                        <th class="p-3 sm:p-4">Kerusakan</th>
                        <th class="p-3 sm:p-4">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-xs font-medium text-gray-700">
                    <tr class="hover:bg-gray-50/50 transition">
                        <td class="p-3 sm:p-4 font-bold text-sky-600">#TK-1002</td>
                        <td class="p-3 sm:p-4 font-semibold text-gray-900">Budi Santoso</td>
                        <td class="p-3 sm:p-4">Asus ROG Strix G15</td>
                        <td class="p-3 sm:p-4 text-gray-500">Mati Total / Overheat</td>
                        <td class="p-3 sm:p-4">
                            <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-amber-50 text-amber-600 border border-amber-200 whitespace-nowrap">
                                Dalam Pengecekan
                            </span>
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-50/50 transition">
                        <td class="p-3 sm:p-4 font-bold text-sky-600">#TK-1001</td>
                        <td class="p-3 sm:p-4 font-semibold text-gray-900">Siti Rahma</td>
                        <td class="p-3 sm:p-4">Lenovo Ideapad Slim 3</td>
                        <td class="p-3 sm:p-4 text-gray-500">Ganti LCD 14 Inch</td>
                        <td class="p-3 sm:p-4">
                            <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-sky-50 text-sky-600 border border-sky-200 whitespace-nowrap">
                                Sedang Dikerjakan
                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection