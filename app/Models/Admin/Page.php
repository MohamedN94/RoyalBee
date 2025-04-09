<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Page extends Model
{
    use HasFactory;

    protected $fillable = ['name_ar', 'name_en', 'page_type_id', 'description_ar', 'description_en', 'slug', 'url', 'order'];

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

    public function pageType(): BelongsTo
    {
        return $this->belongsTo(PageType::class, 'page_type_id');
    }
}
