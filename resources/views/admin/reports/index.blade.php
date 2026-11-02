@extends('layouts.admin')

@section('title', 'Laporan Keuangan & Servis')

@section('content')
<div class="space-y-6">

    <!-- HEADER & FILTER TANGGAL -->
    <div class="bg-white p-6 rounded-3xl border border-slate-200/80 shadow-xs flex flex-col lg:flex-row items-start lg:items-center justify-between gap-4">
        <div>
            <h1 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight">Laporan Keuangan & Servis</h1>
            <p class="text-xs text-slate-500 mt-0.5">Rekapitulasi pendapatan kasir dan statistik transaksi toko.</p>
        </div>

        <form action="{{ route('admin.reports.index') }}" method="GET" class="flex flex-wrap items-center gap-2.5 w-full lg:w-auto">
            <div>
                <input type="date" name="start_date" value="{{ $startDate }}" class="text-xs font-bold bg-slate-50 border border-slate-200 rounded-xl p-2.5 focus:ring-2 focus:ring-sky-500 focus:outline-none">
            </div>
            <span class="text-xs font-bold text-slate-400">s/d</span>
            <div>
                <input type="date" name="end_date" value="{{ $endDate }}" class="text-xs font-bold bg-slate-50 border border-slate-200 rounded-xl p-2.5 focus:ring-2 focus:ring-sky-500 focus:outline-none">
            </div>
            <button type="submit" class="px-4 py-2.5 bg-sky-600 hover:bg-sky-700 text-white text-xs font-bold rounded-xl transition shadow-md shadow-sky-600/20 flex items-center gap-1.5 cursor-pointer">
                <i class="fa-solid fa-filter"></i>
                <span>Filter</span>
            </button>

            <!-- TOMBOL CETAK LAPORAN -->
            <a href="{{ route('admin.reports.print', ['start_date' => $startDate, 'end_date' => $endDate]) }}" target="_blank" class="px-4 py-2.5 bg-slate-800 hover:bg-slate-900 text-white text-xs font-bold rounded-xl transition shadow-md shadow-slate-800/20 flex items-center gap-1.5">
                <i class="fa-solid fa-print"></i>
                <span>Cetak Laporan</span>
            </a>
        </form>
    </div>

    <!-- SUMMARY RINGKASAN BIAYA -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-white p-5 rounded-3xl border border-slate-200/80 shadow-xs">
            <span class="text-[11px] font-bold text-slate-400 uppercase block">Total Tiket Masuk</span>
            <span class="text-2xl font-black text-slate-900 mt-1 block">{{ number_format($totalTickets) }} Unit</span>
            <span class="text-[10px] text-slate-500 font-medium">Lunas & Selesai: {{ number_format($completedCount) }}</span>
        </div>

        <div class="bg-white p-5 rounded-3xl border border-slate-200/80 shadow-xs">
            <span class="text-[11px] font-bold text-slate-400 uppercase block">Total Jasa Servis</span>
            <span class="text-xl font-black text-sky-600 mt-1 block">Rp {{ number_format($totalServiceFee, 0, ',', '.') }}</span>
            <span class="text-[10px] text-slate-500 font-medium">Pendapatan Jasa Toko</span>
        </div>

        <div class="bg-white p-5 rounded-3xl border border-slate-200/80 shadow-xs">
            <span class="text-[11px] font-bold text-slate-400 uppercase block">Total Sparepart</span>
            <span class="text-xl font-black text-indigo-600 mt-1 block">Rp {{ number_format($totalSparepart, 0, ',', '.') }}</span>
            <span class="text-[10px] text-slate-500 font-medium">Pemasukan Komponen</span>
        </div>

        <div class="bg-slate-900 p-5 rounded-3xl text-white shadow-xl shadow-slate-900/10">
            <span class="text-[11px] font-bold text-slate-400 uppercase block">TOTAL OMSET BERSIH</span>
            <span class="text-xl font-black text-emerald-400 mt-1 block">Rp {{ number_format($totalOmset, 0, ',', '.') }}</span>
            <span class="text-[10px] text-slate-400 font-medium">Pendapatan Kasir Lunas</span>
        </div>
    </div>

    <!-- TABEL DATA LAPORAN -->
    <div class="bg-white rounded-3xl border border-slate-200/80 shadow-xs overflow-hidden p-6 space-y-4">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-slate-100 text-[10px] font-bold uppercase tracking-wider text-slate-400 bg-slate-50/50">
                        <th class="py-3 px-4 rounded-l-xl">Tanggal</th>
                        <th class="py-3 px-4">No. Tiket</th>
                        <th class="py-3 px-4">Pelanggan</th>
                        <th class="py-3 px-4">Perangkat</th>
                        <th class="py-3 px-4">Jasa Servis</th>
                        <th class="py-3 px-4">Sparepart</th>
                        <th class="py-3 px-4">Total</th>
                        <th class="py-3 px-4 text-right rounded-r-xl">Status Bayar</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-xs">
                    @forelse ($services as $service)
                        <tr class="hover:bg-slate-50/80 transition">
                            <td class="py-3.5 px-4 font-medium text-slate-600">
                                {{ $service->created_at->format('d/m/Y') }}
                            </td>
                            <td class="py-3.5 px-4 font-mono font-bold text-sky-600">
                                {{ $service->ticket_number }}
                            </td>
                            <td class="py-3.5 px-4 font-bold text-slate-800">
                                {{ $service->customer->name }}
                            </td>
                            <td class="py-3.5 px-4 font-medium text-slate-700">
                                {{ $service->device_name }}
                            </td>
                            <td class="py-3.5 px-4 font-semibold text-slate-800">
                                Rp {{ number_format($service->service_fee ?? 0, 0, ',', '.') }}
                            </td>
                            <td class="py-3.5 px-4 font-semibold text-slate-800">
                                Rp {{ number_format($service->sparepart_fee ?? 0, 0, ',', '.') }}
                            </td>
                            <td class="py-3.5 px-4 font-black text-emerald-600">
                                Rp {{ number_format($service->total_amount ?? 0, 0, ',', '.') }}
                            </td>
                            <td class="py-3.5 px-4 text-right">
                                @if ($service->payment_status === 'paid')
                                    <span class="px-2.5 py-1 bg-emerald-50 text-emerald-700 border border-emerald-200 text-[10px] font-black rounded-lg uppercase">LUNAS</span>
                                @else
                                    <span class="px-2.5 py-1 bg-rose-50 text-rose-700 border border-rose-200 text-[10px] font-black rounded-lg uppercase">BELUM BAYAR</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="py-6 text-center text-slate-400 text-xs">Tidak ada data transaksi pada rentang tanggal ini.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="pt-2">
            {{ $services->links() }}
        </div>
    </div>

</div>
@endsection