<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = ['title_ar','title_en','slug','content_ar','content_en','image'];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->slug = Str::slug($model->title_en);
        });

        static::updating(function ($model) {
            $model->slug = Str::slug($model->title_ar);
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
