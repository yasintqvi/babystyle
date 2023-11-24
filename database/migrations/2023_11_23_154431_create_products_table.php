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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('slug');
            $table->string('primary_image');
            $table->string('secondary_image')->nullable();
            $table->foreignId('category_id')->constrained('categories');
            $table->foreignId('brand_id')->constrained('brands');
            $table->decimal("weight", 10, 2);
            $table->decimal("width", 10, 2)->nullable();
            $table->decimal("height", 10, 2)->nullable();
            $table->decimal("length", 10, 2)->nullable();
            $table->timestamp('published_at');
            $table->tinyInteger('is_active')->default(0)->comment('1 => is active');
            $table->unsignedInteger('sold_number')->comment('sold quantity of this product');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
