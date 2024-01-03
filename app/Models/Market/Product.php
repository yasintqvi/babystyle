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

    public function scopePriceOrder($query, $order = "ASC")
    {
        return request('price') ? $query->orderBy('price', $order) : $query->withPrice()->orderBy('price', $order);
    }

    public function scopeWithPrice($query) {
        return $query->join('product_items', 'products.id', '=', 'product_items.product_id')
            ->select('products.*', 'product_items.price')
            ->where('product_items.is_default', 1);
    }

    public function scopeFilter($query, $filters)
    {
        $filters = collect($filters);

        if ($price = $filters->get('price')) {
            [$price['min'], $price['max']] = [$price['min'] ?? 0, $price['max'] ?? null];

            if ($price['max']) {
                $query->withPrice()->where('price', '>=', $price['min'])->where('price' , "<=" , $price['max']);
            }
            else {
                $query->withPrice()->where('price', '>=', $price['min']);
            }
        }

        // category filter
        if ($filters->get('category')) {
            $query->whereIn('category_id', $filters['category']);
        }

        // sorting products
        switch ($filters->get('sort')) {
            case 'newaest':
                $query->latest();
                break;
            case 'best-seller':
                $query->orderBy('sold_number', 'DESC');
                break;
            case 'cheapest':
                $query->priceOrder();
                break;
            case 'most-expensive':
                $query->priceOrder("DESC");
                break;
            default:
                $query->latest();
                break;
        }

        // search
        if ($keyword = $filters->get('search')) {
            $query->where('title', "LIKE", "%{$keyword}%");
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

}
