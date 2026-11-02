<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nota Servis - {{ $service->ticket_number }}</title>
    
    <!-- BUNDLE VITE PROYEK (TAILWIND & FONTAWESOME) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* ATURAN KHUSUS SAAT DICETAK PRINTER / DIPRINT BROWSER */
        @media print {
            /* Sembunyikan semua elemen di luar nota */
            .no-print {
                display: none !important;
            }
            body {
                background-color: #ffffff !important;
                padding: 0 !important;
                margin: 0 !important;
            }
            /* Hilangkan garis/shadow web agar murni jadi kertas nota thermal */
            .receipt-card {
                box-shadow: none !important;
                border: none !important;
                border-radius: 0 !important;
                width: 100% !important;
                max-width: 100% !important;
                padding: 0 !important;
                margin: 0 !important;
            }
            /* Set margin kertas thermal printer ke nol */
            @page {
                margin: 0;
            }
        }
    </style>
</head>
<body class="bg-slate-200 min-h-screen flex flex-col items-center justify-start p-4 sm:p-6 font-sans text-slate-800">

    <!-- TOMBOL AKSI ATAS (DISEMBUNYIKAN SAAT DICETAK) -->
    <div class="no-print w-full max-w-sm mb-4 flex items-center justify-between gap-2">
        <button onclick="window.close()" class="px-3.5 py-2 bg-white hover:bg-slate-100 text-slate-700 text-xs font-bold rounded-xl transition cursor-pointer flex items-center gap-1.5 shadow-sm border border-slate-200">
            <i class="fa-solid fa-xmark"></i>
            <span>Tutup</span>
        </button>

        <!-- TOMBOL CETAK BROWSER -->
        <button onclick="window.print()" class="px-4 py-2 bg-sky-600 hover:bg-sky-700 text-white text-xs font-bold rounded-xl transition shadow-md shadow-sky-600/20 flex items-center gap-1.5 cursor-pointer">
            <i class="fa-solid fa-print"></i>
            <span>Cetak Struk</span>
        </button>
    </div>

    <!-- TAMPILAN KERTAS NOTA FISIK (BENTUK LEMBARAN STRUK) -->
    <div class="receipt-card w-full max-w-sm bg-white p-6 rounded-2xl shadow-xl border border-slate-200/80 space-y-3.5 my-auto">
        
        <!-- HEADER TOKO -->
        <div class="text-center space-y-0.5 border-b border-dashed border-slate-300 pb-3">
            <h1 class="text-base font-black tracking-wider text-slate-900">INDRA JAYA COMPUTER</h1>
            <p class="text-[10px] text-slate-500 leading-tight">Spesialis Servis Laptop & Komputer<br>Muara Gembong, Bekasi</p>
            <p class="text-[10px] font-bold text-slate-700 pt-0.5">WA: 0812-3456-7890</p>
        </div>

        <!-- INFO TIKET & TANGGAL -->
        <div class="text-xs space-y-1 border-b border-dashed border-slate-300 pb-2.5">
            <div class="flex justify-between items-center">
                <span class="text-slate-500">No. Tiket:</span>
                <span class="font-bold font-mono text-sky-600 text-xs">{{ $service->ticket_number }}</span>
            </div>
            <div class="flex justify-between items-center">
                <span class="text-slate-500">Tanggal:</span>
                <span class="text-slate-800">{{ $service->created_at->format('d/m/Y H:i') }}</span>
            </div>
            <div class="flex justify-between items-center">
                <span class="text-slate-500">Penerima (Kasir):</span>
                <span class="text-slate-800 font-medium">{{ $service->creator->name ?? 'Admin' }}</span>
            </div>
        </div>

        <!-- INFORMASI PELANGGAN -->
        <div class="text-xs space-y-1 border-b border-dashed border-slate-300 pb-2.5">
            <div class="font-bold text-slate-900 uppercase mb-0.5 text-[10px] tracking-wider">Data Pelanggan</div>
            <div class="flex justify-between items-center">
                <span class="text-slate-500">Nama:</span>
                <span class="font-bold text-slate-800">{{ $service->customer->name }}</span>
            </div>
            <div class="flex justify-between items-center">
                <span class="text-slate-500">No. HP:</span>
                <span class="text-slate-800">{{ $service->customer->phone }}</span>
            </div>
        </div>

        <!-- DETAIL PERANGKAT & QR CODE BERDAMPINGAN -->
        <div class="border-b border-dashed border-slate-300 pb-3">
            <div class="font-bold text-slate-900 uppercase text-[10px] mb-1.5 tracking-wider">Detail Perangkat & Tracking</div>
            
            <div class="grid grid-cols-3 gap-2 items-start">
                <!-- KOLOM KIRI (2 SPAN): TIPE & KELUHAN -->
                <div class="col-span-2 space-y-1.5 text-xs">
                    <div>
                        <span class="text-slate-400 block text-[9px] uppercase font-semibold">Tipe Perangkat</span>
                        <span class="font-bold text-slate-900 text-xs block leading-tight">{{ $service->device_name }}</span>
                    </div>

                    @if ($service->serial_number)
                        <div>
                            <span class="text-slate-400 block text-[9px] uppercase font-semibold">No. Seri (S/N)</span>
                            <span class="font-semibold text-slate-800 block text-[11px] font-mono">{{ $service->serial_number }}</span>
                        </div>
                    @endif

                    <div>
                        <span class="text-slate-400 block text-[9px] uppercase font-semibold">Keluhan Utama</span>
                        <span class="text-slate-800 block text-[11px] font-medium leading-snug">
                            {{ $service->complaint }}
                        </span>
                    </div>
                </div>

                <!-- KOLOM KANAN (1 SPAN): QR CODE TRACKING -->
                <div class="col-span-1 flex flex-col items-center justify-center pt-0.5">
                    @php
                        $trackingUrl = url('/track/' . $service->tracking_token);
                        $qrApi = "https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=" . urlencode($trackingUrl);
                    @endphp
                    <div class="p-1 bg-white border border-slate-200 rounded-lg shadow-xs">
                        <img 
                            src="{{ $qrApi }}" 
                            alt="QR Code Tracking" 
                            class="w-16 h-16 object-contain block rounded-md"
                            loading="eager"
                        >
                    </div>
                    <span class="text-[8px] font-bold text-slate-500 uppercase text-center tracking-tighter mt-1 leading-tight">Scan Cek Status</span>
                </div>
            </div>

            @if ($service->conditions)
                <div class="mt-2 text-xs pt-1.5 border-t border-slate-100">
                    <span class="text-slate-400 block text-[9px] uppercase font-semibold">Kondisi Fisik / Kelengkapan</span>
                    <span class="text-slate-700 block text-[10px] italic leading-tight">{{ $service->conditions }}</span>
                </div>
            @endif
        </div>

        <!-- FOOTER & SYARAT KETENTUAN -->
        <div class="text-[9px] text-center space-y-1.5 text-slate-500 pt-0.5">
            <p class="font-bold text-slate-700">*** BUKTI PENERIMAAN UNIT ***</p>
            <p class="leading-tight">Simpan nota ini sebagai bukti sah pengambilan unit. Kerusakan akibat bencana/kelalaian di luar tanggung jawab toko.</p>
            <div class="pt-1.5 border-t border-slate-200 text-slate-400">
                Terima kasih atas kepercayaan Anda!
            </div>
        </div>

    </div>

</body>
</html>