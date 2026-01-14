<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // General attributes (shared)
            $table->string('size')->nullable();                 // e.g., "10 Gallon", "18x18 inch"
            $table->string('shape')->nullable();                // e.g., "Circular", "Rectangular"
            $table->string('material')->nullable();             // e.g., "HDPE", "Fabric", "Non-woven"
            $table->string('color')->nullable();                // e.g., "Green", "Black", "White"
            $table->integer('gsm')->nullable();                 // e.g., 220, 450 (for fabric thickness)
            $table->boolean('has_handles')->default(false);     // For grow bags: true/false
            $table->boolean('uv_treated')->default(false);      // UV protection: true/false

            // Shade net specific
            $table->string('shade_percentage')->nullable();     // e.g., "50%", "75%", "90%"
            $table->decimal('width_meters', 8, 2)->nullable();  // e.g., 3.00, 4.00
            $table->decimal('length_meters', 8, 2)->nullable(); // e.g., 50.00, 100.00

            // Optional extras
            $table->integer('pack_quantity')->default(1);       // e.g., sold as pack of 5
            $table->integer('warranty_months')->nullable();     // e.g., 12, 24
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn([
                'size', 'shape', 'material', 'color', 'gsm', 'has_handles', 'uv_treated',
                'shade_percentage', 'width_meters', 'length_meters', 'pack_quantity', 'warranty_months'
            ]);
        });
    }
};