<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   // database/migrations/xxxx_xx_xx_create_carts_table.php
public function up(): void
{
    Schema::create('carts', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade'); // null for guests
        $table->string('session_id')->nullable(); // for guest carts
        $table->foreignId('product_id')->constrained()->onDelete('cascade');
        $table->integer('quantity')->default(1);
        $table->timestamps();

        // Prevent duplicate products in same cart
        $table->unique(['user_id', 'session_id', 'product_id']);
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
