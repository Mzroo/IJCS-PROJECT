@extends('layouts.admin')

@section('title', 'Daftar Antrean Servis')

@section('content')
<div class="space-y-6">

    <!-- HEADER PAGE -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-xl sm:text-2xl font-black text-slate-900">Daftar Antrean Servis</h1>
            <p class="text-xs text-slate-500 mt-0.5">Kelola seluruh unit perbaikan komputer dan laptop pelanggan</p>
        </div>
        <a href="{{ route('services.create') }}" class="inline-flex items-center justify-center gap-2 bg-sky-600 hover:bg-sky-700 text-white px-5 py-3 rounded-2xl text-xs font-bold shadow-lg shadow-sky-600/20 transition shrink-0">
            <i class="fa-solid fa-plus"></i>
            <span>Terima Unit Baru</span>
        </a>
    </div>

    <!-- FILTER TAB & FORM PENCARIAN -->
    <div class="bg-white p-4 rounded-3xl border border-slate-200/80 shadow-xs flex flex-col md:flex-row items-stretch md:items-center justify-between gap-4">
        
        <!-- TAB NAVIGATION -->
        <div class="flex items-center gap-1.5 bg-slate-100 p-1.5 rounded-2xl text-xs font-bold shrink-0 overflow-x-auto">
            <a href="{{ route('services.index', ['tab' => 'active', 'search' => request('search')]) }}" class="px-4 py-2 rounded-xl transition flex items-center gap-2 {{ $tab === 'active' ? 'bg-white text-sky-600 shadow-xs' : 'text-slate-500 hover:text-slate-900' }}">
                <i class="fa-solid fa-spinner text-[11px]"></i>
                <span>Sedang Diproses</span>
            </a>
            <a href="{{ route('services.index', ['tab' => 'completed', 'search' => request('search')]) }}" class="px-4 py-2 rounded-xl transition flex items-center gap-2 {{ $tab === 'completed' ? 'bg-white text-emerald-600 shadow-xs' : 'text-slate-500 hover:text-slate-900' }}">
                <i class="fa-solid fa-circle-check text-[11px]"></i>
                <span>Selesai & Diambil</span>
            </a>
            <a href="{{ route('services.index', ['tab' => 'all', 'search' => request('search')]) }}" class="px-4 py-2 rounded-xl transition flex items-center gap-2 {{ $tab === 'all' ? 'bg-white text-slate-900 shadow-xs' : 'text-slate-500 hover:text-slate-900' }}">
                <i class="fa-solid fa-layer-group text-[11px]"></i>
                <span>Semua Tiket</span>
            </a>
        </div>

        <!-- SEARCH FORM -->
        <form action="{{ route('services.index') }}" method="GET" class="relative flex-1 max-w-md">
            <input type="hidden" name="tab" value="{{ $tab }}">
            <div class="relative">
                <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                <input type="text" name="search" value="{{ $search }}" placeholder="Cari No. Tiket, Pelanggan, Perangkat..." class="w-full pl-9 pr-8 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-medium text-slate-800 focus:outline-none focus:ring-2 focus:ring-sky-500">
                @if ($search)
                    <a href="{{ route('services.index', ['tab' => $tab]) }}" class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 text-xs">
                        <i class="fa-solid fa-xmark"></i>
                    </a>
                @endif
            </div>
        </form>

    </div>

    <!-- TABEL ANTREAN SERVIS -->
    <div class="bg-white rounded-3xl border border-slate-200/80 shadow-xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/80 border-b border-slate-200/80 text-[10px] font-black text-slate-400 uppercase tracking-wider">
                        <th class="py-4 px-6">No. Tiket</th>
                        <th class="py-4 px-6">Pelanggan</th>
                        <th class="py-4 px-6">Perangkat</th>
                        <th class="py-4 px-6">Teknisi</th>
                        <th class="py-4 px-6">Status</th>
                        <th class="py-4 px-6 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-xs font-medium text-slate-700">
                    @forelse ($services as $service)
                        <tr class="hover:bg-slate-50/50 transition">
                            <!-- NO TIKET & TANGGAL -->
                            <td class="py-4 px-6">
                                <span class="font-mono font-black text-sky-600 bg-sky-50 px-2.5 py-1 rounded-lg border border-sky-100">
                                    {{ $service->ticket_number }}
                                </span>
                                <div class="text-[10px] text-slate-400 mt-1">
                                    {{ $service->created_at->format('d M Y, H:i') }}
                                </div>
                            </td>

                            <!-- NAMA & NO HP PELANGGAN -->
                            <td class="py-4 px-6">
                                <div class="font-bold text-slate-900">{{ $service->customer->name }}</div>
                                <div class="text-[11px] text-slate-400">{{ $service->customer->phone }}</div>
                            </td>

                            <!-- NAMA PERANGKAT & KELUHAN -->
                            <td class="py-4 px-6">
                                <div class="font-bold text-slate-800">{{ $service->device_name }}</div>
                                <div class="text-[11px] text-slate-400 truncate max-w-xs">{{ $service->complaint }}</div>
                            </td>

                            <!-- TEKNISI -->
                            <td class="py-4 px-6">
                                @if ($service->technician)
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-slate-100 text-slate-700 font-semibold">
                                        <i class="fa-solid fa-user-gear text-[10px]"></i>
                                        {{ $service->technician->name }}
                                    </span>
                                @else
                                    <span class="text-amber-600 font-semibold bg-amber-50 px-2.5 py-1 rounded-lg border border-amber-100">
                                        Belum Ditentukan
                                    </span>
                                @endif
                            </td>

                            <!-- BADGE STATUS -->
                            <td class="py-4 px-6">
                                @php
                                    $statusClasses = [
                                        'received'         => 'bg-sky-50 text-sky-700 border-sky-200',
                                        'diagnosing'       => 'bg-amber-50 text-amber-700 border-amber-200',
                                        'waiting_approval' => 'bg-purple-50 text-purple-700 border-purple-200',
                                        'in_progress'      => 'bg-indigo-50 text-indigo-700 border-indigo-200',
                                        'waiting_parts'    => 'bg-orange-50 text-orange-700 border-orange-200',
                                        'completed'        => 'bg-emerald-50 text-emerald-700 border-emerald-200',
                                        'ready_for_pickup' => 'bg-teal-50 text-teal-700 border-teal-200',
                                        'picked_up'        => 'bg-slate-100 text-slate-700 border-slate-200',
                                        'cancelled'        => 'bg-rose-50 text-rose-700 border-rose-200',
                                    ];

                                    $statusLabels = [
                                        'received'         => 'Diterima',
                                        'diagnosing'       => 'Diagnosa',
                                        'waiting_approval' => 'Persetujuan',
                                        'in_progress'      => 'Pengerjaan',
                                        'waiting_parts'    => 'Part',
                                        'completed'        => 'Selesai',
                                        'ready_for_pickup' => 'Siap Ambil',
                                        'picked_up'        => 'Sudah Ambil',
                                        'cancelled'        => 'Batal',
                                    ];
                                @endphp
                                <span class="px-3 py-1 rounded-full border text-[10px] font-black uppercase tracking-wider {{ $statusClasses[$service->status] ?? 'bg-slate-100 text-slate-700' }}">
                                    {{ $statusLabels[$service->status] ?? str_replace('_', ' ', $service->status) }}
                                </span>
                            </td>

                            <!-- TOMBOL AKSI -->
                            <td class="py-4 px-6 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('services.show', $service->getKey()) }}" class="p-2 text-slate-500 hover:text-sky-600 hover:bg-sky-50 rounded-lg transition" title="Lihat Detail">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>

                                    @if (in_array(auth()->user()->role ?? '', ['admin', 'owner']))
                                        <a href="{{ route('services.print-receipt', $service->getKey()) }}" target="_blank" class="p-2 text-slate-500 hover:text-emerald-600 hover:bg-emerald-50 rounded-lg transition" title="Cetak Nota Tanda Terima">
                                            <i class="fa-solid fa-print"></i>
                                        </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-12">
                                <div class="w-16 h-16 bg-slate-50 text-slate-300 rounded-2xl flex items-center justify-center mx-auto mb-3 text-2xl">
                                    <i class="fa-solid fa-inbox"></i>
                                </div>
                                <h3 class="text-sm font-bold text-slate-700">Tidak Ada Data Unit Servis</h3>
                                <p class="text-xs text-slate-400 mt-1">
                                    @if ($search)
                                        Tidak ditemukan unit yang sesuai dengan kata kunci "{{ $search }}".
                                    @else
                                        Belum ada data servis pada kategori tab ini.
                                    @endif
                                </p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- PAGINASI -->
        @if ($services->hasPages())
            <div class="p-4 border-t border-slate-100">
                {{ $services->links() }}
            </div>
        @endif
    </div>

</div>
@endsection