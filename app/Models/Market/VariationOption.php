<?php

namespace App\Models\Market;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VariationOption extends Model
{
    use HasFactory;

    protected $fillable = [
        'variation_id',
        'value',
        'second_value',
        'is_color'  
    ];


    public function productItems()
    {
        return $this->belongsToMany(ProductItem::class, 'product_variation_options');
    }

}
