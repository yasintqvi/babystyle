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

    public function scopeFilter($query, $filters)
    {
        $filters = collect($filters);

        if ($filters->get('category')) {
            $query->whereIn('category_id', $filters['category']);
        }

        if ($sort = $filters->get('sort')) {
            
            if ($sort === 'newaest') {
                $query->latest();
            } 
            
            if ($sort === 'best-seller') {
                $query->orderBy('sold_number', 'DESC');
            } 
            else if ($sort === 'cheapest') {
                $query->select('products.*')
                    ->join('product_items', 'products.id', '=', 'product_items.product_id')
                    ->orderBy('product_items.price')
                    ->get();
            }
            else if ($sort === 'most-expensive') {
                $query->select('products.*')
                    ->join('product_items', 'products.id', '=', 'product_items.product_id')
                    ->orderBy('product_items.price', 'DESC')
                    ->get();
            }
        } else {
            $query->latest();
        }

        if ($keyword = $filters->get('search')) {
            $query->where('title', "LIKE" ,"%{$keyword}%");
        }

        return $query;
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

    public function getQuantityCheckAttribute()
    {
        return $this->items()->where('quantity', '>', '0')->first() ?? 0;
    }


    public function hasVariaty()
    {
        return $this->category->variations->isNotEmpty();
    }

    public function path()
    {
        return route('products.show', $this->slug);
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function commentApproved()
    {
        return $this->hasMany(Comment::class)->where('is_approved', 1);
    }

    public function reats()
    {
        return $this->hasMany(Comment::class);
    }

}
