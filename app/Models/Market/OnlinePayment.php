<?php

namespace App\Models\Market;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OnlinePayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount',
        'user_id',
        'gateway',
        'trans_id',
        'bank_first_response',
        'bank_second_response',
        'is_processed',
        'is_succeed',
    ];

    protected $appends = ['shamsi_payment_date', 'customer_name'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getCustomerNameAttribute($value)
    {
        return "{$this->user->first_name} {$this->user->last_name}";
    }

    public function getShamsiPaymentDateAttribute($value)
    {
        return getJalaliTime($this->created_at);
    }


}
