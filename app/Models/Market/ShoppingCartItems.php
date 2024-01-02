<?php

namespace App\Models\Market;

use App\Models\Market\ShoppingCart;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShoppingCartItems extends Model
{
    use HasFactory;

    protected $fillable = ['cart_id', 'product_item_id', 'quantity'];


    public function shoppingCart()
    {
        return $this->belongsTo(ShoppingCart::class, 'cart_id');
    }
}
