<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;

    protected $fillable = ['name_ar' , 'name_en' , 'country_id'];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
