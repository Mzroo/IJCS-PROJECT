<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceSparepart extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_ticket_id', 'product_id', 'user_id', 'quantity', 'cost_price', 'selling_price', 'subtotal',
    ];

    protected $casts = [
        'cost_price' => 'decimal:2',
        'selling_price' => 'decimal:2',
        'subtotal' => 'decimal:2',
    ];

    public function serviceTicket() { return $this->belongsTo(ServiceTicket::class); }
    public function product() { return $this->belongsTo(Product::class); }
    public function user() { return $this->belongsTo(User::class); }
}