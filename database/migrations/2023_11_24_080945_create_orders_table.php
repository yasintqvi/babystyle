<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->timestamp('order_date');
            $table->foreignId('online_payment_id')->nullable()->constrained('online_payments');
            $table->longText('shipping_address')->nullable();
            $table->foreignId('address_id')->nullable()->constrained('addresses');
            $table->foreignId('shipping_method_id')->nullable()->constrained('shipping_methods');
            $table->unsignedBigInteger('shipping_amount');
            $table->unsignedBigInteger('total_products_amount');
            $table->unsignedBigInteger('order_discount');
            $table->unsignedBigInteger('final_amount');
            $table->string('tracking_code')->nullable();
            $table->tinyInteger('order_status')->default(0);
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
