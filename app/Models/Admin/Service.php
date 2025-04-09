<?php

namespace App\Models\Admin;

use App\Models\Admin\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Service extends Model
{
    use HasFactory;

    protected $fillable = ['title_en','title_ar','description_ar','description_en','short_description_en','short_description_ar','image',
    'icon','category_id','slug','meta_title','meta_description','meta_canonical','meta_opengraph','meta_property','meta_twitter','meta_jsonLd','meta_Keyword'];

    public function Category(){
        return $this->belongsTo(Category::class);
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->slug = Str::slug($model->title_en);
        });

        static::updating(function ($model) {
            $model->slug = Str::slug($model->title_en);
        });
    }

}
