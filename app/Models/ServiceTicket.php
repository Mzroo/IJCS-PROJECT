<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceTicket extends Model
{
    use HasFactory;

    protected $fillable = [
        'ticket_number', 'tracking_token', 'customer_id', 'user_id', 
        'technician_id', 'device_name', 'serial_number', 'complaint', 
        'conditions', 'status', 'payment_status', 'service_fee', 
        'sparepart_fee', 'total_amount', 'paid_amount', 'completion_date', 'pickup_date'
    ];

    protected $casts = [
        'service_fee' => 'decimal:2',
        'sparepart_fee' => 'decimal:2',
        'total_amount' => 'decimal:2',
        'paid_amount' => 'decimal:2',
        'completion_date' => 'datetime',
        'pickup_date' => 'datetime',
    ];

    public function customer() { return $this->belongsTo(Customer::class); }
    public function creator() { return $this->belongsTo(User::class, 'user_id'); }
    public function technician() { return $this->belongsTo(User::class, 'technician_id'); }
    public function detail() { return $this->hasOne(ServiceDetail::class); }
    public function statusHistories() { return $this->hasMany(ServiceStatusHistory::class); }
    public function spareparts() { return $this->hasMany(ServiceSparepart::class); }
    public function payments() { return $this->hasMany(Payment::class); }
}