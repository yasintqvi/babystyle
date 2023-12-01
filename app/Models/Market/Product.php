<?php

namespace App\Models\Market;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = "products";
    protected $guarded = [];

    // protected $fillable = [
    // 'title',
    // 'description',
    // 'slug',
    // 'primary_image',
    // 'secondary_image',
    // 'category_id',
    // 'brand_id',
    // 'weight',
    // 'width',
    // 'height',
    // 'length',
    // 'published_at',
    // 'is_active',
    // 'sold_number'];
}
