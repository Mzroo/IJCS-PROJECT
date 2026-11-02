<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceStatusHistory extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'service_ticket_id', 'user_id', 'previous_status', 'new_status', 'notes', 'created_at',
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    public function serviceTicket() { return $this->belongsTo(ServiceTicket::class); }
    public function user() { return $this->belongsTo(User::class); }
}