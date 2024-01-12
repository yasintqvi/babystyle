<?php

namespace App\Models\Market;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $appends = ['shamsi_order_date', 'customer_name'];

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
        'final_amount',
        'order_status'
    ];

    public function lines()
    {
        return $this->hasMany(OrderLine::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function scopeSearch($query, $keyword)
    {
        return $query->with('user')->whereHas('user', function ($query) use ($keyword) {
            return $query->where('first_name', "LIKE", "%$keyword%")->whereOr('last_name', "LIKE", "%$keyword%");
        });
    }

    public function getShamsiOrderDateAttribute($value)
    {
        return getJalaliTime($this->created_at);
    }

    public function getCustomerNameAttribute($value)
    {
        return "{$this->user->first_name} {$this->user->last_name}";
    }

    public function getOrderStatus()
    {
        if ($this->order_status == 0) {
            return 'پرداخت ناموفق';
        }
        else if($this->order_status == 1) {
            return 'پرداخت شده - در انتظار تایید';
        }
        else if ($this->order_status == 2) {
            return 'آماده سازی و ارسال مرسوله';
        }
        else if($this->order_status == 3) {
            return 'تحویل داده شده';
        }
    }
}
