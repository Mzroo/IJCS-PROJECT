<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Perbaikan - {{ $service->ticket_number }}</title>
    
    <!-- BUNDLE VITE PROYEK (TAILWIND & FONTAWESOME) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-100 min-h-screen text-slate-800 font-sans pb-12">

    <!-- HEADER / NAVBAR SIMPEL -->
    <header class="bg-white border-b border-slate-200 sticky top-0 z-10 shadow-xs">
        <div class="max-w-2xl mx-auto px-4 py-4 flex items-center justify-between">
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 bg-sky-600 rounded-xl flex items-center justify-center text-white font-black text-sm">
                    IJ
                </div>
                <div>
                    <h1 class="text-xs font-black tracking-wider text-slate-900 uppercase">Indra Jaya Computer</h1>
                    <p class="text-[10px] text-slate-500">Service Tracking Center</p>
                </div>
            </div>
            <span class="px-2.5 py-1 bg-slate-100 text-slate-600 text-[10px] font-bold rounded-full border border-slate-200">
                Official Tracking
            </span>
        </div>
    </header>

    <main class="max-w-2xl mx-auto px-4 mt-6 space-y-6">

        <!-- CARD STATUS UTAMA -->
        <div class="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-xs space-y-4">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 border-b border-slate-100 pb-4">
                <div>
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Nomor Tiket</span>
                    <span class="text-lg font-black font-mono text-sky-600">{{ $service->ticket_number }}</span>
                </div>
                
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
                        'received'         => 'Unit Diterima',
                        'diagnosing'       => 'Pengecekan / Diagnosa',
                        'waiting_approval' => 'Menunggu Persetujuan',
                        'in_progress'      => 'Dalam Pengerjaan',
                        'waiting_parts'    => 'Menunggu Sparepart',
                        'completed'        => 'Selesai Diproses',
                        'ready_for_pickup' => 'Siap Diambil',
                        'picked_up'        => 'Unit Sudah Diambil',
                        'cancelled'        => 'Dibatalkan',
                    ];
                @endphp

                <div>
                    <span class="px-3.5 py-1.5 border text-xs font-black rounded-full uppercase tracking-wider inline-block {{ $statusClasses[$service->status] ?? 'bg-slate-100 text-slate-700' }}">
                        {{ $statusLabels[$service->status] ?? str_replace('_', ' ', $service->status) }}
                    </span>
                </div>
            </div>

            <!-- RINCIAN UNIT PELANGGAN -->
            <div class="grid grid-cols-2 gap-4 text-xs">
                <div>
                    <span class="text-slate-400 font-medium block">Pemilik Unit</span>
                    <span class="font-bold text-slate-900 block mt-0.5">{{ $service->customer->name }}</span>
                </div>
                <div>
                    <span class="text-slate-400 font-medium block">Tipe / Merk Unit</span>
                    <span class="font-bold text-slate-900 block mt-0.5">{{ $service->device_name }}</span>
                </div>
                <div class="col-span-2">
                    <span class="text-slate-400 font-medium block">Keluhan Utama</span>
                    <p class="font-semibold text-slate-800 bg-slate-50 p-3 rounded-2xl border border-slate-100 mt-1">
                        {{ $service->complaint }}
                    </p>
                </div>
            </div>
        </div>

        <!-- DIAGNOSA TEKNISI -->
        @if ($service->detail && ($service->detail->diagnosis || $service->detail->action_taken))
            <div class="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-xs space-y-3">
                <h2 class="text-xs font-black text-slate-900 uppercase tracking-wider flex items-center gap-2 border-b border-slate-100 pb-3">
                    <i class="fa-solid fa-microchip text-sky-600"></i>
                    <span>Catatan Pengerjaan Teknisi</span>
                </h2>

                @if ($service->detail->diagnosis)
                    <div>
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Hasil Diagnosa</span>
                        <p class="text-xs text-slate-700 mt-0.5 leading-relaxed">{{ $service->detail->diagnosis }}</p>
                    </div>
                @endif

                @if ($service->detail->action_taken)
                    <div class="pt-2 border-t border-slate-100">
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Tindakan Perbaikan</span>
                        <p class="text-xs text-slate-700 mt-0.5 leading-relaxed">{{ $service->detail->action_taken }}</p>
                    </div>
                @endif
            </div>
        @endif

        <!-- TIMELINE PROGRES SERVIS -->
        <div class="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-xs space-y-4">
            <h2 class="text-xs font-black text-slate-900 uppercase tracking-wider flex items-center gap-2 border-b border-slate-100 pb-3">
                <i class="fa-solid fa-timeline text-sky-600"></i>
                <span>Riwayat Progres Pengerjaan</span>
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
                                {{ $history->created_at->format('d M Y, H:i') }}
                            </span>
                        </div>
                        @if ($history->notes)
                            <p class="text-xs text-slate-600 mt-1 bg-slate-50 p-2.5 rounded-xl border border-slate-100">
                                {{ $history->notes }}
                            </p>
                        @endif
                    </div>
                @empty
                    <p class="text-xs text-slate-400">Belum ada catatan riwayat pengerjaan.</p>
                @endforelse
            </div>
        </div>

        <!-- CARD RINGKASAN BIAYA & STATUS PELUNASAN -->
        <div class="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-xs space-y-3">
            <h2 class="text-xs font-black text-slate-900 uppercase tracking-wider flex items-center gap-2 border-b border-slate-100 pb-3">
                <i class="fa-solid fa-receipt text-emerald-600"></i>
                <span>Informasi Pembayaran</span>
            </h2>

            <div class="flex justify-between items-center py-1 text-xs">
                <span class="text-slate-500">Total Estimasi / Biaya</span>
                <span class="font-black text-slate-900 text-sm">Rp {{ number_format($service->total_amount ?? 0, 0, ',', '.') }}</span>
            </div>

            <div class="flex justify-between items-center py-1 text-xs border-t border-slate-100 pt-3">
                <span class="text-slate-500 font-medium">Status Pembayaran</span>
                @if ($service->payment_status === 'paid')
                    <span class="px-3 py-1 bg-emerald-50 text-emerald-700 border border-emerald-200 text-xs font-black rounded-lg uppercase">
                        LUNAS
                    </span>
                @else
                    <span class="px-3 py-1 bg-rose-50 text-rose-700 border border-rose-200 text-xs font-black rounded-lg uppercase">
                        BELUM DIBAYAR
                    </span>
                @endif
            </div>
        </div>

        <!-- KONTAK BANTUAN TOKO -->
        <div class="text-center text-xs text-slate-400 space-y-1 pt-4">
            <p class="font-medium text-slate-600">Ada pertanyaan mengenai perbaikan unit Anda?</p>
            <p>Hubungi WhatsApp Customer Service: <a href="https://wa.me/6281234567890" target="_blank" class="font-bold text-emerald-600 hover:underline">0812-3456-7890</a></p>
        </div>

    </main>

</body>
</html>