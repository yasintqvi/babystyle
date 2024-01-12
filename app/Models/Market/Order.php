<?php

namespace App\Models\Market;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    const ORDER_STATUSES = [
        'delivered' => 'تحویل شده ها',
        'processing' => 'در حال پردازش',
        'order_confirm' => 'در انتظار تایید',
        'unpaid' => 'پرداخت ناموفق',
    ];

    protected $fillable = [
        'user_id',
        'order_date',
        'online_payment_id',
        'shipping_address',
        'address_id',
        'shipping_method_id',
        'shipping_amount',
        'total_products_amount',
        'order_discount',
        'final_amount' ,
        'order_status'
    ];

    public function lines()
    {
        return $this->hasMany(OrderLine::class);
    }
}
