<?php

namespace App\Models\Market;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_date',
        'online_payment_id',
        'shipping_address',
        'address_id',
        'shipping_method_id',
        'shipping_amount',
        'total_product_amount',
        'order_discount',
        'final_amount' ,
        'order_status'
    ];
}
