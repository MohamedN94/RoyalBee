<?php

namespace App\Models\Admin;

use App\Models\Review;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;
use App\Scopes\ProductScope;
use App\Scopes\Filter;

class Product extends Model
{
    protected $fillable = [
        'name_ar',
        'name_en',
        'description_ar',
        'description_en',
        'image',
        'price',
        'discount_price',
        'slug',
        'category_id',
        'sku',
        'sale_start_date',
        'sale_end_date',
        'tax_rate',
        'stock',
        'trending_product',
        'best_seller',
        'review',
        'video',
        'short_desc_ar',
        'short_desc_en',
        'meta_title_ar',
        'meta_title_en',
        'meta_description_ar',
        'meta_description_en',
        'alt_image',
        'type'
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->slug = Str::slug($model->name_en);
        });

        static::updating(function ($model) {
            $model->slug = Str::slug($model->name_en);
        });
    }

    protected static function booted()
    {
        if (!app()->runningInConsole() && request()->is('admin*')) {
            static::addGlobalScope(new ProductScope);
            static::addGlobalScope(new Filter);
        }
    }

    public function photos(): HasMany
    {
        return $this->hasMany(Photo::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function updateAverageRating()
    {
        $averageRating = $this->reviews()->avg('rating');
        $this->review = $averageRating;
        $this->save();
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function getFinalPriceAttribute()
    {
        if ($this->discount_price && (!$this->sale_start_date || !$this->sale_end_date || $this->isSaleActive())) {
            return $this->discount_price;
        }

        // Otherwise, return the regular price
        return $this->price;
    }

    private function isSaleActive()
    {
        return now()->between($this->sale_start_date, $this->sale_end_date);
    }

    public function attributes()
    {
        return $this->hasMany(ProductAttribute::class);
    }
    public function attributeValues()
    {
        return $this->hasManyThrough(ProductAttributeValue::class, ProductAttribute::class , 'product_id', 'attribute_id');
    }
}
