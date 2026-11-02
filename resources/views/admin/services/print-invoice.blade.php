<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nota Lunas - {{ $service->ticket_number }}</title>
    <style>
        @page {
            size: 80mm auto;
            margin: 0;
        }
        body {
            font-family: 'Courier New', Courier, monospace;
            width: 72mm;
            margin: 0 auto;
            padding: 8px 0;
            font-size: 11px;
            color: #000;
            line-height: 1.3;
        }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .font-bold { font-weight: bold; }
        .uppercase { text-transform: uppercase; }
        .divider {
            border-top: 1px dashed #000;
            margin: 6px 0;
        }
        .flex-between {
            display: flex;
            justify-content: space-between;
        }
        .badge-paid {
            border: 2px solid #000;
            padding: 3px 8px;
            display: inline-block;
            font-weight: bold;
            font-size: 12px;
            margin: 6px 0;
        }
        @media print {
            body { width: 100%; }
            .no-print { display: none; }
        }
    </style>
</head>
<body onload="window.print()">

    <!-- TOMBOL CETAK MANUAL (DILUAR HASIL PRINT) -->
    <div class="no-print" style="margin-bottom: 10px; text-align: center;">
        <button onclick="window.print()" style="padding: 5px 15px; cursor: pointer;">Cetak Nota</button>
        <button onclick="window.close()" style="padding: 5px 15px; cursor: pointer;">Tutup</button>
    </div>

    <!-- HEADER TOKO -->
    <div class="text-center">
        <div class="font-bold uppercase" style="font-size: 14px;">INDRA JAYA COMPUTER</div>
        <div>Jl. Raya Muara Gembong, Bekasi</div>
        <div>Telp/WA: 0812-3456-7890</div>
    </div>

    <div class="divider"></div>

    <!-- INFORMASI NOTA -->
    <div class="text-center font-bold uppercase">KWITANSI / NOTA PELUNASAN</div>
    <div class="flex-between" style="margin-top: 4px;">
        <span>No. Tiket</span>
        <span class="font-bold">{{ $service->ticket_number }}</span>
    </div>
    <div class="flex-between">
        <span>Tanggal Lunas</span>
        <span>{{ $service->updated_at->format('d/m/Y H:i') }}</span>
    </div>
    <div class="flex-between">
        <span>Pelanggan</span>
        <span>{{ $service->customer->name }}</span>
    </div>
    <div class="flex-between">
        <span>Kasir</span>
        <span>{{ $service->creator->name ?? 'Admin' }}</span>
    </div>

    <div class="divider"></div>

    <!-- DETAIL PERANGKAT -->
    <div><span class="font-bold">Perangkat:</span> {{ $service->device_name }}</div>
    @if ($service->serial_number)
        <div><span class="font-bold">S/N:</span> {{ $service->serial_number }}</div>
    @endif

    <div class="divider"></div>

    <!-- RINCIAN BIAYA -->
    <div class="flex-between">
        <span>Jasa Servis</span>
        <span>Rp {{ number_format($service->service_fee ?? 0, 0, ',', '.') }}</span>
    </div>
    <div class="flex-between">
        <span>Sparepart / Komponen</span>
        <span>Rp {{ number_format($service->sparepart_fee ?? 0, 0, ',', '.') }}</span>
    </div>

    <div class="divider"></div>

    <!-- TOTAL & STATUS -->
    <div class="flex-between font-bold" style="font-size: 12px;">
        <span>TOTAL BAYAR</span>
        <span>Rp {{ number_format($service->total_amount ?? 0, 0, ',', '.') }}</span>
    </div>

    <div class="text-center" style="margin-top: 6px;">
        <span class="badge-paid">*** LUNAS ***</span>
    </div>

    <div class="divider"></div>

    <!-- FOOTER & GARANSI -->
    <div class="text-center" style="font-size: 9px; margin-top: 4px;">
        <div>Terima kasih atas kepercayaan Anda!</div>
        <div style="margin-top: 3px;">* Garansi servis berlaku 7 hari sejak tanggal pengambilan untuk kerusakan yang sama.</div>
        <div>* Nota & segel servis wajib utuh.</div>
    </div>

</body>
</html>