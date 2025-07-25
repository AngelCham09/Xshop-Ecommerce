<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Product extends Model
{
    use HasFactory, HasSlug, SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'quantity',
        'description',
        'publised',
        'inStock',
        'price',
        'created_by',
        'updated_by',
        'deleted_by',
        'brand_id',
        'category_id',

    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function product_images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function cartItem()
    {
        return $this->hasMany(CartItem::class);
    }

    public function orderItem()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function scopeFiltered(Builder $query)
    {
        $query
        ->when(request('brands'), function (Builder $q){
            $q->whereIn('brand_id', request('brands'));
        })
        ->when(request('categories'), function (Builder $q) {
            $q->whereIn('category_id', request('categories'));
        })
        ->when(request('prices'), function (Builder $q) {
            $q->whereBetween('price', [
                request('prices.from', 0),
                request('prices.to', 1000000)
            ]);
        });
    }
}
