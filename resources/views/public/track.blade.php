<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Servis #{{ $service->ticket_number }} - Indra Jaya Computer</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-900 min-h-screen font-sans text-slate-100 antialiased flex flex-col justify-between">

    <!-- HEADER BRANDING -->
    <header class="border-b border-slate-800 bg-slate-950/80 backdrop-blur-md sticky top-0 z-50">
        <div class="max-w-xl mx-auto px-4 py-4 flex items-center justify-between">
            <div class="flex items-center gap-2.5">
                <div class="w-9 h-9 rounded-xl bg-gradient-to-tr from-sky-600 to-blue-500 flex items-center justify-center text-white font-black shadow-lg shadow-sky-500/20">
                    IJ
                </div>
                <div>
                    <h1 class="text-sm font-black tracking-wider text-white">INDRA JAYA COMPUTER</h1>
                    <p class="text-[10px] text-slate-400">Layanan Tracking Servis Online</p>
                </div>
            </div>
            <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-slate-800 text-sky-400 border border-slate-700">
                Live Status
            </span>
        </div>
    </header>

    <!-- CONTENT CONTAINER -->
    <main class="max-w-xl mx-auto px-4 py-6 w-full space-y-6 flex-1">

        <!-- KARTU RINGKASAN TIKET -->
        <div class="bg-slate-800/80 border border-slate-700/80 rounded-2xl p-5 shadow-xl space-y-4 backdrop-blur-sm">
            <div class="flex justify-between items-start border-b border-slate-700/60 pb-3">
                <div>
                    <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400 block">Nomor Tiket</span>
                    <span class="text-lg font-black font-mono text-sky-400">{{ $service->ticket_number }}</span>
                </div>
                <div class="text-right">
                    <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400 block">Tanggal Masuk</span>
                    <span class="text-xs text-slate-200 font-medium">{{ $service->created_at->format('d M Y, H:i') }}</span>
                </div>
            </div>

            <!-- DETAIL PERANGKAT -->
            <div class="grid grid-cols-2 gap-3 text-xs">
                <div>
                    <span class="text-[10px] text-slate-400 block uppercase font-medium">Pemilik</span>
                    <span class="font-semibold text-slate-200">{{ $service->customer->name }}</span>
                </div>
                <div>
                    <span class="text-[10px] text-slate-400 block uppercase font-medium">Perangkat</span>
                    <span class="font-semibold text-slate-200">{{ $service->device_name }}</span>
                </div>
                <div class="col-span-2 bg-slate-900/60 p-3 rounded-xl border border-slate-800">
                    <span class="text-[10px] text-slate-400 block uppercase font-medium mb-0.5">Keluhan Utama</span>
                    <p class="text-xs text-slate-300 leading-relaxed">{{ $service->complaint }}</p>
                </div>
            </div>
        </div>

        <!-- TIMELINE RIWAYAT STATUS -->
        <div class="bg-slate-800/80 border border-slate-700/80 rounded-2xl p-5 shadow-xl space-y-4">
            <h2 class="text-xs font-bold uppercase tracking-wider text-slate-400 flex items-center gap-2">
                <i class="fa-solid fa-clock-rotate-left text-sky-400"></i> Progres Pengerjaan
            </h2>

            <div class="relative pl-6 border-l-2 border-slate-700 space-y-6">
                @foreach ($service->statusHistories->reverse() as $history)
                    <div class="relative">
                        <!-- Titik Indicator Status -->
                        <div class="absolute -left-[31px] top-0.5 w-4 h-4 rounded-full border-2 border-slate-900 {{ $loop->first ? 'bg-sky-500 ring-4 ring-sky-500/20' : 'bg-slate-600' }}"></div>
                        
                        <div class="space-y-1">
                            <div class="flex items-center justify-between">
                                <span class="text-xs font-bold uppercase tracking-wide {{ $loop->first ? 'text-sky-400' : 'text-slate-300' }}">
                                    @switch($history->new_status)
                                        @case('received') Unit Diterima @break
                                        @case('checking') Pengecekan / Diagnosa @break
                                        @case('working') Pengerjaan Servis @break
                                        @case('pending_sparepart') Menunggu Sparepart @break
                                        @case('completed') Servis Selesai @break
                                        @case('taken') Unit Sudah Diambil @break
                                        @case('cancelled') Dibatalkan @break
                                        @default({{ $history->new_status }})
                                    @endswitch
                                </span>
                                <span class="text-[10px] text-slate-500 font-mono">{{ $history->created_at->format('d/m/Y H:i') }}</span>
                            </div>
                            
                            @if ($history->notes)
                                <p class="text-xs text-slate-400 bg-slate-900/40 p-2.5 rounded-lg border border-slate-800/80 leading-relaxed">
                                    {{ $history->notes }}
                                </p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </main>

    <!-- FOOTER INFORMASI -->
    <footer class="border-t border-slate-800 bg-slate-950/80 py-4 text-center text-[10px] text-slate-500">
        <p>Indra Jaya Computer &bull; Muara Gembong, Bekasi</p>
        <p class="mt-0.5">Ada pertanyaan? Hubungi WA Toko: <span class="text-slate-300 font-bold">0812-3456-7890</span></p>
    </footer>

</body>
</html>