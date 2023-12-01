<?php

namespace App\Models\Market;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'sku',
        'quantity',
        'product_image',
        'price',
        'frozen_number',
        'sold_number',];
}
