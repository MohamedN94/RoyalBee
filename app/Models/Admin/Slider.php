<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;

    protected $fillable = ['title_ar', 'title_en', 'description_ar', 'description_en', 'sort', 'image','image_ar','link','mobile_image','mobile_image_ar','status'];
}
