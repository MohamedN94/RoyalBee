<?php

namespace App\Models\Site;

use App\Models\Admin\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'title_en', 'title_ar', 'description_ar', 'description_en', 'short_description_en', 'short_description_ar', 'image',
        'icon', 'category_id', 'slug'
    ];

    public function Category()
    {
        return $this->belongsTo(Category::class);
    }

    function getRouteKeyName()
    {
        return 'slug';
    }
}
