<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('orders', function (Blueprint $table) {
        $table->id();
        $table->string('order_number')->unique(); // e.g., ORD-20251224-0001
        $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete(); // Guest orders allowed
        $table->decimal('subtotal', 10, 2);
        $table->decimal('tax', 10, 2)->default(0);
        $table->decimal('shipping', 10, 2)->default(0);
        $table->decimal('total', 10, 2);
        $table->string('status')->default('pending'); // pending, processing, shipped, delivered, cancelled
        $table->string('payment_status')->default('pending'); // pending, paid, failed, refunded
        $table->string('payment_method')->nullable(); // cash_on_delivery, razorpay, etc.
        $table->json('shipping_address'); // Store full address as JSON
        $table->text('notes')->nullable();
        $table->timestamps();
    });
}
2. Migration: create_order_items_table
PHP

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
