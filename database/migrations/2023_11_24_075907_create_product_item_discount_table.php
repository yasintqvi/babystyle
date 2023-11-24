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
        Schema::create('product_item_discount', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_item_id')->constrained('product_items');
            $table->unsignedInteger('discount_rate');
            $table->unsignedBigInteger('discount_ceiling')->nullable();
            $table->timestamp('start_date')->useCurrent();
            $table->timestamp('end_date')->useCurrent();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_item_discount');
    }
};
