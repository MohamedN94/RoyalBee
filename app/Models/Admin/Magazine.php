<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Magazine extends Model
{
    use HasFactory;

    protected $fillable = ['name','location','description','address','phone','country_id','cover'];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function places()
    {
        return $this->hasMany(Place::class, 'magazine_id');
    }

}
