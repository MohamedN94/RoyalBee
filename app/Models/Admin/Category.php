<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{

    protected $fillable = ['name_ar', 'name_en', 'image', 'slug', 'description_ar', 'description_en', 'banner_image'];

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

    public function products()
    {
        return $this->hasMany(Product::class)->where('is_visible', 1);
    }
}
