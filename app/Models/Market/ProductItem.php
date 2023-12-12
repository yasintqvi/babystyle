<?php

namespace App\Models\Market;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

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
        'sold_number',
    ];


    // relations 
    public function variationOptions()
    {
        return $this->belongsToMany(VariationOption::class, 'product_variation_options');
    }

    public function getImageAttribute() {
        return $this->product_image ?? "defaults/no-image.jpg";
    }

    // set sku
    public static function generateSKU()
    {
        $sku = "BBY-" . rand(11111, 99999);

        while (ProductItem::where('sku', $sku)->exists()) {
            $sku = "BBY" . rand(11111, 99999);
        }

        return $sku;
    }
}
