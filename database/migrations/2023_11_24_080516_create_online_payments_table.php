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
        Schema::create('online_payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('amount');
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->string('gateway')->nullable();
            $table->string('trans_id')->nullable();
            $table->text('bank_first_response')->nullable();
            $table->text('bank_second_response')->nullable();
            $table->tinyInteger('is_processed')->default(1);
            $table->tinyInteger('is_succeed')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('online_payments');
    }
};
