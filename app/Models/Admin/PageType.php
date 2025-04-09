<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageType extends Model
{
    use HasFactory;

    protected $fillable = ['name_ar', 'name_en'];
}
