<?php

namespace App\Models\Market;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    const SEARCH_KEY = 'title';

    protected $fillable = ['title','content', 'tags', 'is_active'];

    // for when the user searches
    public function scopeSearch($query, $keyword)
    {
        return $query->where('title', "LIKE", "%$keyword%");
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    public function scopeNotActive($query)
    {
        return $query->where('is_active', 0);
    }

}
