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

    // scopes
    public function scopeSearch($query, $keyword)
    {
        return $query->where('alt', "LIKE", "%$keyword%");
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    public function scopeNotActive($query)
    {
        return $query->where('is_active', 0);
    }

    // accessor
    public function setUrlAttribute($url)
    {
        str_contains($url, request()->root()) ?
            $this->attributes['url'] = str_replace(request()->root(), '', $url) : $this->attributes['url'] = $url;
    }
   
}
