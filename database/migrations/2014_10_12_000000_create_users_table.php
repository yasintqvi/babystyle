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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('phone_number')->nullable()->unique();
            $table->string('email')->nullable()->unique();
            $table->timestamp('phone_verified_at')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('national_code')->unique()->nullable();
            $table->string('image')->nullable();
            $table->tinyInteger('is_admin')->default(0)->comment('1 => is superuser');
            $table->tinyInteger('is_staff')->default(0)->comment('1 => is employee');
            $table->tinyInteger('is_active')->default(0)->comment('1 => is active');
            $table->tinyInteger('is_banned')->default(0)->comment('1 => is banned');
            $table->timestamp('activated_at')->nullable();
            $table->string('password')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
