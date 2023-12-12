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
        Schema::create('product_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products');
            $table->string('sku')->index()->nullable();
            $table->unsignedInteger('quantity')->comment('quantity in stock without order');
            $table->string('product_image')->nullable();
            $table->unsignedBigInteger('price');
            $table->integer('frozen_number')->default(0)->comment('some that have arrived at the order stage');
            $table->integer('sold_number')->default(0)->comment('sold quantity of this product');
            $table->timestamps();
        }); 
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_items');
    }
};
