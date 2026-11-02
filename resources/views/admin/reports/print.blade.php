<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Keuangan Servis ({{ $startDate }} s/d {{ $endDate }})</title>
    <style>
        @page {
            size: A4 portrait;
            margin: 15mm;
        }
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 11px;
            color: #333;
            line-height: 1.4;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
            margin-bottom: 15px;
        }
        .header h1 {
            font-size: 18px;
            margin: 0;
            text-transform: uppercase;
        }
        .header p {
            margin: 2px 0 0 0;
            font-size: 11px;
        }
        .meta-info {
            margin-bottom: 15px;
        }
        .summary-grid {
            display: table;
            width: 100%;
            margin-bottom: 15px;
            border-collapse: collapse;
        }
        .summary-box {
            display: table-cell;
            width: 25%;
            padding: 8px;
            border: 1px solid #ddd;
            text-align: center;
            background-color: #f9f9f9;
        }
        .summary-box .title {
            font-size: 9px;
            font-weight: bold;
            color: #666;
            text-transform: uppercase;
        }
        .summary-box .value {
            font-size: 12px;
            font-weight: bold;
            margin-top: 4px;
        }
        table.data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table.data-table th, table.data-table td {
            border: 1px solid #ddd;
            padding: 6px 8px;
            text-align: left;
        }
        table.data-table th {
            background-color: #f2f2f2;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 9px;
        }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .font-bold { font-weight: bold; }
        @media print {
            .no-print { display: none; }
        }
    </style>
</head>
<body onload="window.print()">

    <div class="no-print" style="margin-bottom: 15px; text-align: right;">
        <button onclick="window.print()" style="padding: 6px 16px; cursor: pointer;">Cetak Dokumen</button>
        <button onclick="window.close()" style="padding: 6px 16px; cursor: pointer;">Tutup</button>
    </div>

    <div class="header">
        <h1>INDRA JAYA COMPUTER SERVICE</h1>
        <p>Jl. Raya Muara Gembong, Kabupaten Bekasi, Jawa Barat | Telp: 0812-3456-7890</p>
        <p style="font-weight: bold; margin-top: 5px;">LAPORAN REKAPITULASI TRANSAKSI & KEUANGAN SERVIS</p>
    </div>

    <div class="meta-info">
        <strong>Periode Laporan:</strong> {{ \Carbon\Carbon::parse($startDate)->format('d/m/Y') }} s/d {{ \Carbon\Carbon::parse($endDate)->format('d/m/Y') }}<br>
        <strong>Dicetak Pada:</strong> {{ date('d/m/Y H:i') }} WIB
    </div>

    <div class="summary-grid">
        <div class="summary-box">
            <div class="title">Total Tiket</div>
            <div class="value">{{ number_format($totalTickets) }} Unit</div>
        </div>
        <div class="summary-box">
            <div class="title">Total Jasa Servis</div>
            <div class="value">Rp {{ number_format($totalServiceFee, 0, ',', '.') }}</div>
        </div>
        <div class="summary-box">
            <div class="title">Total Sparepart</div>
            <div class="value">Rp {{ number_format($totalSparepart, 0, ',', '.') }}</div>
        </div>
        <div class="summary-box">
            <div class="title">Total Omset Lunas</div>
            <div class="value">Rp {{ number_format($totalOmset, 0, ',', '.') }}</div>
        </div>
    </div>

    <table class="data-table">
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="12%">Tanggal</th>
                <th width="15%">No. Tiket</th>
                <th width="18%">Pelanggan</th>
                <th width="18%">Perangkat</th>
                <th width="12%" class="text-right">Jasa</th>
                <th width="12%" class="text-right">Sparepart</th>
                <th width="12%" class="text-right">Total</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($services as $index => $service)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $service->created_at->format('d/m/Y') }}</td>
                    <td class="font-bold">{{ $service->ticket_number }}</td>
                    <td>{{ $service->customer->name }}</td>
                    <td>{{ $service->device_name }}</td>
                    <td class="text-right">Rp {{ number_format($service->service_fee ?? 0, 0, ',', '.') }}</td>
                    <td class="text-right">Rp {{ number_format($service->sparepart_fee ?? 0, 0, ',', '.') }}</td>
                    <td class="text-right font-bold">Rp {{ number_format($service->total_amount ?? 0, 0, ',', '.') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">Tidak ada transaksi pada periode ini.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <table style="width: 100%; margin-top: 30px;">
        <tr>
            <td width="70%"></td>
            <td width="30%" class="text-center">
                Bekasi, {{ date('d F Y') }}<br>
                Owner Indra Jaya Computer<br><br><br><br>
                ( _________________________ )
            </td>
        </tr>
    </table>

</body>
</html>