<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_ticket_id', 'technician_id', 'diagnosis', 'action_taken', 'internal_notes',
    ];

    public function serviceTicket() { return $this->belongsTo(ServiceTicket::class); }
    public function technician() { return $this->belongsTo(User::class, 'technician_id'); }
}