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

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
