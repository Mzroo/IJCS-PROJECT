<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Service\StoreServiceRequest;
use App\Models\Customer;
use App\Models\ServiceDetail;
use App\Models\ServiceStatusHistory;
use App\Models\ServiceTicket;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ServiceController extends Controller
{
/**
     * Tampilkan daftar antrean servis dengan filter tab & pencarian.
     */
    public function index(Request $request): View
    {
        $tab =$request->query('tab', 'active');
        $search =$request->query('search');

        $query = ServiceTicket::with(['customer', 'technician', 'creator']);

        // Filter berdasarkan Tab
        if ($tab === 'active') {
            // Hanya servis yang masih dalam proses
            $query->whereNotIn('status', ['picked_up', 'cancelled']);
        } elseif ($tab === 'completed') {
            // Servis yang sudah selesai dan diambil/dibatalkan
            $query->whereIn('status', ['picked_up', 'cancelled']);
        }

        // Filter berdasarkan pencarian kata kunci (No Tiket, Nama/HP Pelanggan, Nama Perangkat)
        if ($search) {$query->where(function ($q) use ($search) {
                $q->where('ticket_number', 'LIKE', "\%{$search}%")
                  ->orWhere('device_name', 'LIKE', "%{$search}%")
                  ->orWhereHas('customer', function ($c) use ($search) {
                      $c->where('name', 'LIKE', "\%{$search}%")
                        ->orWhere('phone', 'LIKE', "%{$search}%");
                  });
            });
        }

        $services =$query->latest()->paginate(10)->withQueryString();

        return view('admin.services.index', compact('services', 'tab', 'search'));
    }

    /**
     * Tampilkan form terima unit servis baru.
     */
    public function create(): View
    {
        // Ambil daftar user dengan role teknisi yang aktif
        $technicians = User::where('role', 'teknisi')
            ->where('is_active', true)
            ->get();

        return view('admin.services.create', compact('technicians'));
    }

    /**
     * Simpan transaksi penerimaan unit servis baru.
     */
    public function store(StoreServiceRequest $request): RedirectResponse
    {
        /** @var \App\Models\User|null $currentUser */
        $currentUser = Auth::user();

        if (!$currentUser) {
            return redirect()->route('login')->withErrors([
                'email' => 'Sesi Anda telah berakhir, silakan login kembali.'
            ]);
        }

        $ticket = DB::transaction(function () use ($request, $currentUser) {
            // 1. Cari pelanggan berdasarkan No HP atau buat baru jika belum ada
            $customer = Customer::firstOrCreate(
                ['phone' => $request->customer_phone],
                [
                    'name'    => $request->customer_name,
                    'address' => $request->customer_address,
                ]
            );

            // Update nama jika ada perubahan pada No HP yang sama
            if ($customer->name !== $request->customer_name) {
                $customer->update(['name' => $request->customer_name]);
            }

            // 2. Generate Nomor Tiket Unik Format: TK-YYYYMMDD-XXX
            $datePrefix = 'TK-' . date('Ymd') . '-';
            $lastTicket = ServiceTicket::where('ticket_number', 'LIKE', $datePrefix . '%')
                ->latest('id')
                ->first();

            $nextSequence = $lastTicket ? ((int) substr($lastTicket->ticket_number, -3)) + 1 : 1;
            $ticketNumber = $datePrefix . str_pad((string) $nextSequence, 3, '0', STR_PAD_LEFT);

            // 3. Simpan Service Ticket
            $ticket = ServiceTicket::create([
                'ticket_number'  => $ticketNumber,
                'tracking_token' => Str::random(32),
                'customer_id'    => $customer->id,
                'user_id'        => $currentUser->getKey(),
                'technician_id'  => $request->technician_id,
                'device_name'    => $request->device_name,
                'serial_number'  => $request->serial_number,
                'complaint'      => $request->complaint,
                'conditions'     => $request->conditions,
                'status'         => 'received',
                'payment_status' => 'unpaid',
            ]);

            // 4. Buat Record Service Detail Awal
            ServiceDetail::create([
                'service_ticket_id' => $ticket->id,
                'technician_id'     => $request->technician_id,
            ]);

            // 5. Catat Log Riwayat Status Pertama
            ServiceStatusHistory::create([
                'service_ticket_id' => $ticket->id,
                'user_id'           => $currentUser->getKey(),
                'old_status'        => null,
                'new_status'        => 'received',
                'notes'             => 'Unit berhasil diterima di konter servis.',
            ]);

            return $ticket;
        });

        return redirect()->route('services.show', $ticket->id)
            ->with('status', "Tiket servis {$ticket->ticket_number} berhasil dibuat!");
    }

    /**
     * Detail rincian tiket servis.
     */
    public function show(ServiceTicket $service): View
    {
        $service->load(['customer', 'creator', 'technician', 'detail', 'statusHistories.user', 'spareparts.product']);

        return view('admin.services.show', compact('service'));
    }

    /**
     * Menampilkan halaman cetak struk/nota penerimaan unit servis.
     */
    public function printReceipt(ServiceTicket $service): View
    {
        $service->load(['customer', 'creator']);

        return view('admin.services.print-receipt', compact('service'));
    }

    /**
     * Update status pengerjaan tiket servis.
     */
    public function updateStatus(Request $request, ServiceTicket $service): RedirectResponse
    {
        $validated = $request->validate([
            'status' => 'required|in:received,diagnosing,waiting_approval,in_progress,waiting_parts,completed,ready_for_pickup,picked_up,cancelled',
            'notes'  => 'nullable|string|max:500',
        ]);

        /** @var \App\Models\User|null $currentUser */
        $currentUser = Auth::user();

        if (!$currentUser) {
            return redirect()->route('login')->withErrors([
                'email' => 'Sesi Anda telah berakhir, silakan login kembali.'
            ]);
        }

        $oldStatus = $service->status;
        $service->status = $validated['status'];

        if ($validated['status'] === 'picked_up' && !$service->pickup_date) {
            $service->pickup_date = now();
        }

        if ($validated['status'] === 'completed' && !$service->completion_date) {
            $service->completion_date = now();
        }

        $service->save();

        // Catat histori perubahan status (menggunakan getKey() untuk menghindari warning linter)
        $service->statusHistories()->create([
            'user_id'    => $currentUser->getKey(),
            'old_status' => $oldStatus,
            'new_status' => $validated['status'],
            'notes'      => $validated['notes'] ?? null,
        ]);

        return redirect()->back()->with('status', 'Status pengerjaan berhasil diperbarui.');
    }

    /**
     * Memproses pelunasan transaksi servis unit di kasir.
     */
    public function processPayment(Request $request, ServiceTicket $service): RedirectResponse
    {
        $request->validate([
            'service_fee'    => 'required|numeric|min:0',
            'sparepart_fee'  => 'required|numeric|min:0',
            'payment_method' => 'required|in:cash,transfer,qris',
        ]);

        /** @var \App\Models\User|null $currentUser */
        $currentUser = Auth::user();

        if (!$currentUser) {
            return redirect()->route('login')->withErrors([
                'email' => 'Sesi Anda telah berakhir, silakan login kembali.'
            ]);
        }

        $totalAmount = $request->service_fee + $request->sparepart_fee;
        $oldStatus = $service->status;

        DB::transaction(function () use ($service, $request, $totalAmount, $currentUser, $oldStatus) {
            // Update nominal biaya, status pembayaran, dan status tiket ke picked_up
            $service->update([
                'service_fee'    => $request->service_fee,
                'sparepart_fee'  => $request->sparepart_fee,
                'total_amount'   => $totalAmount,
                'paid_amount'    => $totalAmount,
                'payment_status' => 'paid',
                'status'         => 'picked_up',
                'pickup_date'    => now(),
            ]);

            // Catat log perubahan status di riwayat pengerjaan
            ServiceStatusHistory::create([
                'service_ticket_id' => $service->id,
                'user_id'           => $currentUser->getKey(),
                'old_status'        => $oldStatus,
                'new_status'        => 'picked_up',
                'notes'             => 'Pelunasan transaksi berhasil (Metode: ' . strtoupper($request->payment_method) . ') dan unit resmi diserahkan ke pelanggan.',
            ]);
        });

        return redirect()->back()->with('status', 'Pembayaran berhasil dilunasi! Unit resmi diserahkan.');
    }

    /**
     * Menampilkan halaman cetak nota pelunasan/invoice akhir unit servis.
     */
    public function printInvoice(ServiceTicket $service): View
    {
        $service->load(['customer', 'creator', 'technician']);

        return view('admin.services.print-invoice', compact('service'));
    }
}