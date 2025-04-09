<?php

namespace App\Models\Site;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seo extends Model
{
    use HasFactory;
    protected $fillable = ['page_title','meta_title','meta_description','meta_canonical','meta_opengraph','meta_property','meta_twitter','meta_jsonLd','meta_Keyword'];
}
