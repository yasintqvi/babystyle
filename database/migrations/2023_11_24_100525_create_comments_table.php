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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('product_item_id')->constrained('product_items');
            $table->foreignId('parent_id')->nullable()->constrained('comments');
            $table->text('description');
            $table->tinyInteger('is_seen')->default(0);
            $table->tinyInteger('is_approved')->default(0);
            $table->unsignedDecimal(1,1)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
