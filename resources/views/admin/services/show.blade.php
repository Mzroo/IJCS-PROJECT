@extends('layouts.admin')

@section('title', 'Detail Tiket ' . $service->ticket_number)

@section('content')
<div class="space-y-6">

    <!-- ALERT SUCCESS -->
    @if (session('status'))
        <div class="p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs sm:text-sm rounded-2xl font-semibold flex items-center justify-between">
            <div class="flex items-center gap-2">
                <i class="fa-solid fa-circle-check text-emerald-600 text-base"></i>
                <span>{{ session('status') }}</span>
            </div>
            
            @if (in_array(auth()->user()->role ?? '', ['admin', 'owner']))
                <a href="{{ route('services.print-receipt', $service->getKey()) }}" target="_blank" class="bg-emerald-600 hover:bg-emerald-700 text-white px-3.5 py-1.5 rounded-xl text-xs font-bold transition flex items-center gap-1.5">
                    <i class="fa-solid fa-print"></i>
                    <span>Cetak Struk/Nota</span>
                </a>
            @endif
        </div>
    @endif

    <!-- HEADER DETAIL TIKET & AKSI -->
    <div class="bg-white p-6 rounded-3xl border border-slate-200/80 shadow-xs flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <div class="flex items-center gap-2 mb-1">
                <span class="px-3 py-1 bg-sky-50 text-sky-600 border border-sky-200 text-xs font-black rounded-full uppercase tracking-wider">
                    {{ $service->ticket_number }}
                </span>
                
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
                        'diagnosing'       => 'Pengecekan / Diagnosa',
                        'waiting_approval' => 'Menunggu Persetujuan',
                        'in_progress'      => 'Dalam Pengerjaan',
                        'waiting_parts'    => 'Menunggu Sparepart',
                        'completed'        => 'Selesai Diproses',
                        'ready_for_pickup' => 'Siap Diambil',
                        'picked_up'        => 'Sudah Diambil',
                        'cancelled'        => 'Dibatalkan',
                    ];
                @endphp
                <span class="px-3 py-1 border text-xs font-black rounded-full uppercase tracking-wider {{ $statusClasses[$service->status] ?? 'bg-slate-100 text-slate-700' }}">
                    Status: {{ $statusLabels[$service->status] ?? str_replace('_', ' ', $service->status) }}
                </span>
            </div>
            <h1 class="text-xl sm:text-2xl font-black text-slate-900 mt-2">{{ $service->device_name }}</h1>
            <p class="text-xs text-slate-500 mt-0.5">
                Penerima: <span class="font-bold text-slate-800">{{ $service->creator->name ?? 'Kasir' }}</span> • 
                Waktu Masuk: <span class="font-bold text-slate-800">{{ $service->created_at->format('d M Y, H:i') }} WIB</span>
            </p>
        </div>

        <div class="flex items-center gap-2">
            <a href="{{ route('services.index') }}" class="px-4 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold rounded-xl transition">
                <i class="fa-solid fa-arrow-left mr-1"></i> Kembali
            </a>

            @if (in_array(auth()->user()->role ?? '', ['admin', 'owner']))
                <a href="{{ route('services.print-receipt', $service->getKey()) }}" target="_blank" class="px-4 py-2.5 bg-sky-600 hover:bg-sky-700 text-white text-xs font-bold rounded-xl transition shadow-md shadow-sky-600/20 flex items-center gap-1.5">
                    <i class="fa-solid fa-print"></i>
                    <span>Cetak Tanda Terima</span>
                </a>
            @endif
        </div>
    </div>

    <!-- GRID UTAMA -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- KOLOM KIRI (2 SPAN): KELUHAN, DIAGNOSA & LOG STATUS -->
        <div class="lg:col-span-2 space-y-6">

            <!-- KELUHAN & KONDISI FISIK -->
            <div class="bg-white p-6 rounded-3xl border border-slate-200/80 shadow-xs space-y-4">
                <h2 class="text-sm font-bold text-slate-900 border-b border-slate-100 pb-3 flex items-center gap-2">
                    <i class="fa-solid fa-laptop-code text-sky-600"></i>
                    <span>Rincian Kerusakan & Kondisi Fisik</span>
                </h2>

                <div class="space-y-3">
                    <div>
                        <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Keluhan Utama Pelanggan</span>
                        <p class="text-xs font-semibold text-slate-800 bg-slate-50 p-3.5 rounded-2xl border border-slate-100 mt-1">
                            {{ $service->complaint }}
                        </p>
                    </div>

                    <div>
                        <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Kondisi Fisik / Kelengkapan Unit</span>
                        <p class="text-xs font-semibold text-slate-800 bg-slate-50 p-3.5 rounded-2xl border border-slate-100 mt-1">
                            {{ $service->conditions ?? 'Tidak ada catatan kondisi khusus / kelengkapan standar.' }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- CATATAN DIAGNOSA TEKNISI -->
            <div class="bg-white p-6 rounded-3xl border border-slate-200/80 shadow-xs space-y-4">
                <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                    <h2 class="text-sm font-bold text-slate-900 flex items-center gap-2">
                        <i class="fa-solid fa-microchip text-sky-600"></i>
                        <span>Pemeriksaan & Tindakan Teknisi</span>
                    </h2>
                    <span class="text-xs font-bold text-slate-500">
                        Teknisi: <strong class="text-slate-900">{{ $service->technician->name ?? 'Belum Ditetapkan' }}</strong>
                    </span>
                </div>

                <div class="space-y-3">
                    <div>
                        <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Hasil Diagnosa Kerusakan</span>
                        <p class="text-xs font-medium text-slate-700 bg-slate-50 p-3.5 rounded-2xl border border-slate-100 mt-1">
                            {{ $service->detail->diagnosis ?? 'Belum ada catatan diagnosa dari teknisi.' }}
                        </p>
                    </div>

                    <div>
                        <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Tindakan Perbaikan</span>
                        <p class="text-xs font-medium text-slate-700 bg-slate-50 p-3.5 rounded-2xl border border-slate-100 mt-1">
                            {{ $service->detail->action_taken ?? 'Belum ada tindakan perbaikan yang dicatat.' }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- HISTORI STATUS TIKET -->
            <div class="bg-white p-6 rounded-3xl border border-slate-200/80 shadow-xs space-y-4">
                <h2 class="text-sm font-bold text-slate-900 border-b border-slate-100 pb-3 flex items-center gap-2">
                    <i class="fa-solid fa-timeline text-sky-600"></i>
                    <span>Riwayat Perubahan Status</span>
                </h2>

                <div class="relative pl-6 space-y-6 before:absolute before:left-2 before:top-2 before:bottom-2 before:w-0.5 before:bg-slate-200">
                    @forelse ($service->statusHistories as $history)
                        <div class="relative">
                            <div class="absolute -left-6 top-1 w-3 h-3 bg-sky-600 rounded-full ring-4 ring-sky-50"></div>
                            <div class="flex items-center justify-between">
                                <span class="text-xs font-bold text-slate-900 uppercase">
                                    {{ $statusLabels[$history->new_status] ?? str_replace('_', ' ', $history->new_status) }}
                                </span>
                                <span class="text-[10px] text-slate-400 font-medium">
                                    {{ $history->created_at->format('d M Y, H:i') }} WIB
                                </span>
                            </div>
                            <p class="text-xs text-slate-600 mt-0.5">{{ $history->notes ?? 'Tidak ada catatan.' }}</p>
                            <span class="text-[10px] text-slate-400">Oleh: {{ $history->user->name ?? 'Sistem' }}</span>
                        </div>
                    @empty
                        <p class="text-xs text-slate-400">Belum ada riwayat perubahan status.</p>
                    @endforelse
                </div>
            </div>

        </div>

        <!-- KOLOM KANAN (1 SPAN): FORM KASIR, UPDATE STATUS, PELANGGAN & RINGKASAN BIAYA -->
        <div class="space-y-6">

            <!-- CARD FORM KASIR & PELUNASAN SERVIS (KHUSUS ADMIN & OWNER) -->
            @if (in_array(auth()->user()->role ?? '', ['admin', 'owner']))
                <div class="bg-white p-6 rounded-3xl border border-slate-200/80 shadow-xs space-y-4">
                    <h2 class="text-sm font-bold text-slate-900 border-b border-slate-100 pb-3 flex items-center gap-2">
                        <i class="fa-solid fa-cash-register text-emerald-600"></i>
                        <span>Kasir & Pelunasan Servis</span>
                    </h2>

                    @if ($service->payment_status === 'paid')
                        <div class="p-4 bg-emerald-50 border border-emerald-200 rounded-2xl text-center space-y-2">
                            <i class="fa-solid fa-circle-check text-emerald-600 text-2xl"></i>
                            <p class="text-xs font-black text-emerald-800 uppercase tracking-wider">Transaksi Lunas</p>
                            <p class="text-[10px] text-emerald-600 font-medium">Unit telah diserahkan & pembayaran dicatat.</p>
                            
                            <a href="{{ route('services.print-invoice', $service->getKey()) }}" target="_blank" class="inline-flex items-center justify-center gap-1.5 w-full py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold rounded-xl transition shadow-xs mt-1">
                                <i class="fa-solid fa-print"></i>
                                <span>Cetak Struk Pelunasan</span>
                            </a>
                        </div>
                    @else
                        <form action="{{ route('services.process-payment', $service->getKey()) }}" method="POST" class="space-y-3">
                            @csrf

                            <div>
                                <label class="block text-[11px] font-bold text-slate-500 uppercase mb-1">Biaya Jasa Servis (Rp)</label>
                                <input type="number" name="service_fee" value="{{ old('service_fee', $service->service_fee ?? 0) }}" min="0" required class="w-full text-xs font-bold text-slate-800 bg-slate-50 border border-slate-200 rounded-xl p-2.5 focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                            </div>

                            <div>
                                <label class="block text-[11px] font-bold text-slate-500 uppercase mb-1">Biaya Sparepart (Rp)</label>
                                <input type="number" name="sparepart_fee" value="{{ old('sparepart_fee', $service->sparepart_fee ?? 0) }}" min="0" required class="w-full text-xs font-bold text-slate-800 bg-slate-50 border border-slate-200 rounded-xl p-2.5 focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                            </div>

                            <div>
                                <label class="block text-[11px] font-bold text-slate-500 uppercase mb-1">Metode Pembayaran</label>
                                <select name="payment_method" class="w-full text-xs font-bold text-slate-800 bg-slate-50 border border-slate-200 rounded-xl p-2.5 focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                                    <option value="cash">Tunai (Cash)</option>
                                    <option value="transfer">Transfer Bank</option>
                                    <option value="qris">QRIS</option>
                                </select>
                            </div>

                            <button type="submit" onclick="return confirm('Apakah Anda yakin ingin memproses pelunasan transaksi ini?')" class="w-full py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold rounded-xl transition shadow-md shadow-emerald-600/20 flex items-center justify-center gap-2 cursor-pointer mt-2">
                                <i class="fa-solid fa-receipt"></i>
                                <span>Proses Pelunasan</span>
                            </button>
                        </form>
                    @endif
                </div>
            @endif

            <!-- FORM UPDATE STATUS PENGERJAAN (BISA UNTUK TEKNISI, ADMIN, OWNER) -->
            <div class="bg-white p-6 rounded-3xl border border-slate-200/80 shadow-xs space-y-4">
                <h2 class="text-sm font-bold text-slate-900 border-b border-slate-100 pb-3 flex items-center gap-2">
                    <i class="fa-solid fa-pen-to-square text-sky-600"></i>
                    <span>Update Status Servis</span>
                </h2>

                <form action="{{ route('services.update-status', $service->getKey()) }}" method="POST" class="space-y-3.5">
                    @csrf
                    @method('PATCH')

                    <div>
                        <label class="block text-[11px] font-bold text-slate-500 uppercase mb-1">Status Baru</label>
                        <select name="status" class="w-full text-xs font-bold text-slate-800 bg-slate-50 border border-slate-200 rounded-xl p-2.5 focus:ring-2 focus:ring-sky-500 focus:outline-none">
                            <option value="received" {{ $service->status === 'received' ? 'selected' : '' }}>Unit Diterima</option>
                            <option value="diagnosing" {{ $service->status === 'diagnosing' ? 'selected' : '' }}>Pengecekan / Diagnosa</option>
                            <option value="waiting_approval" {{ $service->status === 'waiting_approval' ? 'selected' : '' }}>Menunggu Persetujuan</option>
                            <option value="in_progress" {{ $service->status === 'in_progress' ? 'selected' : '' }}>Dalam Pengerjaan</option>
                            <option value="waiting_parts" {{ $service->status === 'waiting_parts' ? 'selected' : '' }}>Menunggu Sparepart</option>
                            <option value="completed" {{ $service->status === 'completed' ? 'selected' : '' }}>Selesai Diproses</option>
                            <option value="ready_for_pickup" {{ $service->status === 'ready_for_pickup' ? 'selected' : '' }}>Siap Diambil</option>
                            
                            @if (in_array(auth()->user()->role ?? '', ['admin', 'owner']))
                                <option value="picked_up" {{ $service->status === 'picked_up' ? 'selected' : '' }}>Sudah Diambil</option>
                            @endif

                            <option value="cancelled" {{ $service->status === 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-[11px] font-bold text-slate-500 uppercase mb-1">Catatan Pengerjaan</label>
                        <textarea name="notes" rows="3" placeholder="Tambahkan catatan progres pengerjaan..." class="w-full text-xs text-slate-800 bg-slate-50 border border-slate-200 rounded-xl p-2.5 focus:ring-2 focus:ring-sky-500 focus:outline-none"></textarea>
                    </div>

                    <button type="submit" class="w-full py-2.5 bg-sky-600 hover:bg-sky-700 text-white text-xs font-bold rounded-xl transition shadow-md shadow-sky-600/20 flex items-center justify-center gap-2 cursor-pointer">
                        <i class="fa-solid fa-floppy-disk"></i>
                        <span>Simpan Perubahan Status</span>
                    </button>
                </form>
            </div>

            <!-- CARD PELANGGAN -->
            <div class="bg-white p-6 rounded-3xl border border-slate-200/80 shadow-xs space-y-4">
                <h2 class="text-sm font-bold text-slate-900 border-b border-slate-100 pb-3 flex items-center gap-2">
                    <i class="fa-solid fa-address-card text-sky-600"></i>
                    <span>Informasi Pelanggan</span>
                </h2>

                <div class="space-y-3 text-xs">
                    <div>
                        <span class="text-slate-400 font-medium block">Nama Pelanggan</span>
                        <span class="font-bold text-slate-900 text-sm block">{{ $service->customer->name }}</span>
                    </div>

                    <div>
                        <span class="text-slate-400 font-medium block">Nomor WhatsApp / HP</span>
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $service->customer->phone) }}" target="_blank" class="font-bold text-emerald-600 hover:text-emerald-700 flex items-center gap-1.5 mt-0.5">
                            <i class="fa-brands fa-whatsapp text-sm"></i>
                            <span>{{ $service->customer->phone }}</span>
                        </a>
                    </div>

                    <div>
                        <span class="text-slate-400 font-medium block">Alamat</span>
                        <span class="font-semibold text-slate-700 block mt-0.5">
                            {{ $service->customer->address ?? 'Alamat tidak diisi' }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- CARD RINGKASAN BIAYA -->
            <div class="bg-white p-6 rounded-3xl border border-slate-200/80 shadow-xs space-y-4">
                <h2 class="text-sm font-bold text-slate-900 border-b border-slate-100 pb-3 flex items-center gap-2">
                    <i class="fa-solid fa-receipt text-sky-600"></i>
                    <span>Ringkasan Biaya</span>
                </h2>

                <div class="space-y-2 text-xs">
                    <div class="flex justify-between py-1">
                        <span class="text-slate-500">Biaya Jasa Servis</span>
                        <span class="font-bold text-slate-900">Rp {{ number_format($service->service_fee ?? 0, 0, ',', '.') }}</span>
                    </div>

                    <div class="flex justify-between py-1">
                        <span class="text-slate-500">Biaya Sparepart</span>
                        <span class="font-bold text-slate-900">Rp {{ number_format($service->sparepart_fee ?? 0, 0, ',', '.') }}</span>
                    </div>

                    <div class="border-t border-slate-100 pt-3 flex justify-between items-center">
                        <span class="font-black text-slate-900 text-xs">TOTAL BIAYA</span>
                        <span class="font-black text-sky-600 text-base">Rp {{ number_format($service->total_amount ?? 0, 0, ',', '.') }}</span>
                    </div>

                    <div class="pt-2">
                        <span class="text-[10px] uppercase font-bold tracking-wider text-slate-400 block">Status Pembayaran</span>
                        @if ($service->payment_status === 'paid')
                            <span class="inline-block mt-1 px-3 py-1 bg-emerald-50 text-emerald-700 border border-emerald-200 text-xs font-black rounded-lg uppercase">LUNAS</span>
                        @else
                            <span class="inline-block mt-1 px-3 py-1 bg-rose-50 text-rose-700 border border-rose-200 text-xs font-black rounded-lg uppercase">BELUM DIBAYAR</span>
                        @endif
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>
@endsection