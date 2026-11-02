<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('service_tickets', function (Blueprint $table) {
            $table->id();
            $table->string('ticket_number')->unique()->index();
            $table->string('tracking_token', 32)->unique()->index();
            $table->foreignId('customer_id')->constrained('customers')->onDelete('restrict');
            $table->foreignId('user_id')->constrained('users')->onDelete('restrict');
            $table->foreignId('technician_id')->nullable()->constrained('users')->onDelete('set null');
            $table->string('device_name');
            $table->string('serial_number')->nullable();
            $table->text('complaint');
            $table->text('conditions')->nullable();
            $table->enum('status', [
                'received', 'diagnosing', 'waiting_approval', 
                'in_progress', 'waiting_parts', 'completed', 
                'ready_for_pickup', 'picked_up', 'cancelled'
            ])->default('received');
            $table->enum('payment_status', ['unpaid', 'partial', 'paid'])->default('unpaid');
            $table->decimal('service_fee', 12, 2)->default(0.00);
            $table->decimal('sparepart_fee', 12, 2)->default(0.00);
            $table->decimal('total_amount', 12, 2)->default(0.00);
            $table->decimal('paid_amount', 12, 2)->default(0.00);
            $table->timestamp('completion_date')->nullable();
            $table->timestamp('pickup_date')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('service_tickets');
    }
};