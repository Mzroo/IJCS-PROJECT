<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'payment_number', 'service_ticket_id', 'user_id', 'amount', 
        'payment_method', 'reference_number', 'status', 'confirmed_by', 'confirmed_at', 'notes',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'confirmed_at' => 'datetime',
    ];

    public function serviceTicket() { return $this->belongsTo(ServiceTicket::class); }
    public function user() { return $this->belongsTo(User::class); }
    public function confirmedBy() { return $this->belongsTo(User::class, 'confirmed_by'); }
    public function transaction() { return $this->hasOne(Transaction::class); }
}