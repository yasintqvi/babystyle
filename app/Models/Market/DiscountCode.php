<?php

namespace App\Models\Market;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscountCode extends Model
{
    use HasFactory;

    protected $fillable = [
        'code' ,
        'type' ,
        'description' ,
        'discount_rate' ,
        'discount_ceiling' ,
        'start_date' ,
        'end_date',
        'name' ,
        'amount'
    ];

    protected $appends = ['start_date_status'];

    public function getStartDateStatusAttribute()
    {
        return $this->end_date <= now() ? 'منقضی' : 'منتشر شده'  ;
    }

    public function isActive() 
    {
        return $this->start_date <= now() and $this->end_date >= now();
    }

    public function scopeSearch($query, $keyword)
    {
        return $query->where('name', "LIKE", "%$keyword%");
    }

    public function scopeAmount($query)
    {
        return $query->where('type', 1);
    }

    public function scopeRate($query)
    {
        return $query->where('type', 0);
    }

    
    
}
