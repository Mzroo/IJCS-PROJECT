<div class="space-y-5 text-slate-800">

    <!-- HEADER POPUP: NOMOR TIKET & BADGE STATUS -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 border-b border-slate-100 pb-4">
        <div>
            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Nomor Tiket Servis</span>
            <span class="text-xl font-black font-mono text-sky-600">{{ $service->ticket_number }}</span>
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
    <div class="grid grid-cols-2 gap-3 text-xs bg-slate-50/80 p-4 rounded-2xl border border-slate-100">
        <div>
            <span class="text-slate-400 font-medium block">Pemilik Unit</span>
            <span class="font-bold text-slate-900 block mt-0.5">{{ $service->customer->name }}</span>
        </div>
        <div>
            <span class="text-slate-400 font-medium block">Tipe / Merk Unit</span>
            <span class="font-bold text-slate-900 block mt-0.5">{{ $service->device_name }}</span>
        </div>
        <div class="col-span-2 pt-2 border-t border-slate-200/60">
            <span class="text-slate-400 font-medium block">Keluhan Utama</span>
            <p class="font-semibold text-slate-800 mt-0.5">
                {{ $service->complaint }}
            </p>
        </div>
    </div>

    <!-- DIAGNOSA TEKNISI -->
    @if ($service->detail && ($service->detail->diagnosis || $service->detail->action_taken))
        <div class="space-y-2 border-t border-slate-100 pt-3">
            <h4 class="text-xs font-black text-slate-900 uppercase tracking-wider flex items-center gap-1.5">
                <i class="fa-solid fa-microchip text-sky-600"></i>
                <span>Catatan Pengerjaan Teknisi</span>
            </h4>

            @if ($service->detail->diagnosis)
                <div class="bg-sky-50/60 p-3 rounded-xl border border-sky-100 text-xs">
                    <span class="text-[10px] font-bold text-sky-700 uppercase tracking-wider block">Hasil Diagnosa</span>
                    <p class="text-slate-700 mt-0.5 leading-relaxed">{{ $service->detail->diagnosis }}</p>
                </div>
            @endif

            @if ($service->detail->action_taken)
                <div class="bg-emerald-50/60 p-3 rounded-xl border border-emerald-100 text-xs">
                    <span class="text-[10px] font-bold text-emerald-700 uppercase tracking-wider block">Tindakan Perbaikan</span>
                    <p class="text-slate-700 mt-0.5 leading-relaxed">{{ $service->detail->action_taken }}</p>
                </div>
            @endif
        </div>
    @endif

    <!-- TIMELINE PROGRES SERVIS -->
    <div class="space-y-3 border-t border-slate-100 pt-3">
        <h4 class="text-xs font-black text-slate-900 uppercase tracking-wider flex items-center gap-1.5">
            <i class="fa-solid fa-timeline text-sky-600"></i>
            <span>Riwayat Progres Pengerjaan</span>
        </h4>

        <div class="relative pl-5 space-y-4 before:absolute before:left-2 before:top-2 before:bottom-2 before:w-0.5 before:bg-slate-200 max-h-48 overflow-y-auto pr-1">
            @forelse ($service->statusHistories as $history)
                <div class="relative">
                    <div class="absolute -left-5 top-1 w-2.5 h-2.5 bg-sky-600 rounded-full ring-4 ring-sky-50"></div>
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold text-slate-900 uppercase">
                            {{ $statusLabels[$history->new_status] ?? str_replace('_', ' ', $history->new_status) }}
                        </span>
                        <span class="text-[10px] text-slate-400 font-medium">
                            {{ $history->created_at->format('d M Y, H:i') }}
                        </span>
                    </div>
                    @if ($history->notes)
                        <p class="text-xs text-slate-600 mt-1 bg-slate-50 p-2 rounded-lg border border-slate-100">
                            {{ $history->notes }}
                        </p>
                    @endif
                </div>
            @empty
                <p class="text-xs text-slate-400">Belum ada catatan riwayat pengerjaan.</p>
            @endforelse
        </div>
    </div>

    <!-- BIAYA & STATUS PELUNASAN -->
    <div class="bg-slate-900 text-white p-4 rounded-2xl flex justify-between items-center text-xs shadow-md">
        <div>
            <span class="text-[10px] text-slate-400 block uppercase font-bold">Total Estimasi Biaya</span>
            <span class="font-black text-lg text-emerald-400 font-mono">Rp {{ number_format($service->total_amount ?? 0, 0, ',', '.') }}</span>
        </div>
        <div>
            @if ($service->payment_status === 'paid')
                <span class="px-3 py-1.5 bg-emerald-500/20 text-emerald-300 border border-emerald-500/30 text-xs font-black rounded-xl uppercase">
                    <i class="fa-solid fa-check-circle mr-1"></i> LUNAS
                </span>
            @else
                <span class="px-3 py-1.5 bg-rose-500/20 text-rose-300 border border-rose-500/30 text-xs font-black rounded-xl uppercase">
                    <i class="fa-solid fa-clock mr-1"></i> BELUM DIBAYAR
                </span>
            @endif
        </div>
    </div>

    <!-- WA BANTUAN -->
    <div class="text-center text-xs text-slate-400 pt-1">
        <span>Ada kendala? </span>
        <a href="https://wa.me/6281234567890?text=Halo%20Admin%20IJCS,%20saya%20mau%20tanya%20progres%20nota%20{{ $service->ticket_number }}" target="_blank" class="font-bold text-emerald-600 hover:underline">
            <i class="fa-brands fa-whatsapp"></i> Chat WhatsApp Admin
        </a>
    </div>

</div>