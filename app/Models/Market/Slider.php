<?php

namespace App\Models\Market;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;

    protected $fillable = ['alt','url','image', 'is_active'];
    protected $casts = ['image' => 'array'];

    public function getISActiveAttribute($is_active){
        return $is_active ? "فعال" : "غیرفعال";
    }

    // accessor
    public function setUrlAttribute($url)
    {
        str_contains($url, request()->root()) ?
            $this->attributes['url'] = str_replace(request()->root(), '', $url) : $this->attributes['url'] = $url;
    }
   
}
