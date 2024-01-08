<?php

namespace App\Models\Market;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $table = "addresses";
    protected $fillable = ['user_id', 'province_id', 'city_id' , 'address' , 'postal_code' , 'plaque' , 'unit' , 'receiver_phone_number' , 'receiver_full_name' , 'is_default'];

    
}
