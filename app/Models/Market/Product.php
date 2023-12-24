<?php

namespace App\Models\Market;

use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory, Sluggable;

    protected $table = "products";



    protected $fillable = [
        'title',
        'description',
        'slug',
        'primary_image',
        'secondary_image',
        'category_id',
        'brand_id',
        'weight',
        'width',
        'height',
        'length',
        'published_at',
        'is_active',
        'sold_number',
        'quantity',
        'price'
    ];



    // scopes
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

    // relations
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function attributes()
    {
        return $this->hasMany(ProductAttribute::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function items()
    {
        return $this->hasMany(ProductItem::class);
    }

    // public function finalDiscounts()
    // {
    //     return $this->items();
    // }

    

    public function getQuantityCheckAttribute()
    {
        return $this->items()->where('quantity' , '>' , '0')->first() ?? 0;
    }

    
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

}
