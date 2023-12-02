<?php

namespace App\Models\Market;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasFactory;

    protected $fillable = ['question','answer', 'tags', 'is_active'];

    // for when the user searches
    public function scopeSearch($query, $keyword)
    {
        return $query->where('question', "LIKE", "%$keyword%");
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
