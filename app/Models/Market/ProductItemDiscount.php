<?php

namespace App\Models\Market;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductItemDiscount extends Model
{
    use HasFactory;

    protected $table = "product_item_discount";

    protected $fillable = [
        'product_item_id',
        'discount_rate',
        'start_date',
        'end_date',
    ];

    public function getIsActiveAttribute() {
        return $this->start_date <= now() && $this->end_date >= now();
    }

    // set scopes
    public function scopeActive($query) {
        return $query->where('start_date', '<=', now())->where('end_date', '>=', now());
    }


}
