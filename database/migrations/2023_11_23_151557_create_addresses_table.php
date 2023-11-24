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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('city_id')->default('cities');
            $table->text('address');
            $table->string('postal_code');
            $table->string('plaque');
            $table->integer('unit')->default(0);
            $table->string('receiver_phone_number')->nullable();
            $table->string('receiver_full_name')->nullable();
            $table->tinyInteger('is_default')->default(0);
            $table->timestamps();
        });

        Schema::create('user_address', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('address_id')->constrained('addresses');
            $table->primary(['user_id', 'address_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_address');
        Schema::dropIfExists('addresses');
    }
};
