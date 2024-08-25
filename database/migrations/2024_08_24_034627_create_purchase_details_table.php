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
        Schema::create('purchase_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('purchase_id')->constrained('purchases');
            $table->foreignId('item_id')->constrained('items');
            $table->string('item_name');
            $table->decimal('item_price', 10, 2);
            $table->string('item_measurement_unit')->nullable();
            $table->string('item_currency_code')->nullable();
            $table->string('item_image_url')->nullable();
            $table->integer('quantity');
            $table->decimal('subtotal_price', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_details');
    }
};
