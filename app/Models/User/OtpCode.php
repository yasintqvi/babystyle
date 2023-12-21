<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtpCode extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'expired_at',
        'user_id'
    ];

    public function scopeHasExpired($query) 
    {
        $query->where('expired_at' , '>' , now());
    }
}
