<?php

namespace App\Models\Market;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasFactory;

    protected $fillable = ['question','answer', 'tags', 'is_active'];

    public function getISActiveAttribute($is_active){
        return $is_active ? "فعال" : "غیرفعال";
    }

}
