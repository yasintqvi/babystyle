<?php

namespace App\Models\Market;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    const SEARCH_KEY = 'title';

    protected $fillable = ['title','content', 'tags', 'is_active'];

    public function getISActiveAttribute($is_active){
        return $is_active ? "فعال" : "غیرفعال";
    }

}
