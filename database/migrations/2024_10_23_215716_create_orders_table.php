<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('vendor_id')->constrained('vendors');
            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();
            $table->string('invoice_no')->unique();
            $table->string('payment_method');
            $table->enum('status', ['pending', 'confirmed','processing', 'delivering', 'completed', 'cancelled', 'refunded'])
                ->default('pending');
            $table->enum('payment_status', ['pending', 'paid', 'failed'])
                ->default('paid');
            $table->float('shipping')->default(0);
            $table->float('tax')->default(0);
            $table->float('discount')->default(0);
            $table->float('total')->default(0);
            $table->string('coupon')->nullable();
            $table->date('confirmed_date')->nullable();
            $table->date('processing_date')->nullable();
            $table->date('shipped_date')->nullable();
            $table->date('delivered_date')->nullable();
            $table->date('cancel_date')->nullable();
            $table->date('refunded_date')->nullable();
            $table->date('refunded_reason')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
