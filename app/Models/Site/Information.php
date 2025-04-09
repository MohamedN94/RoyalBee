<?php

namespace App\Models\Site;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Information extends Model
{
    use HasFactory;
    protected $table = 'information';
    protected $fillable = [
        'phone', 'about_ar', 'about_en', 'address_ar', 'address_en', 'email', 'logo',
        'support_number', 'facebook', 'twitter', 'linkedIn', 'instagram','footer_image'
    ];
}
