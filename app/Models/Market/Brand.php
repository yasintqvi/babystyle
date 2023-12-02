<?php

namespace App\Models\Market;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory, Sluggable;

    protected $table = "brands";
    protected $fillable = ['persian_name', 'original_name', 'logo', 'slug'];
    protected $casts = ['logo' => 'array'];
    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */

    public function scopeSearch($query, $keyword)
    {
        return $query->where('persian_name', "LIKE", "%$keyword%");
    }


    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'original_name'
            ]
        ];
    }
}
