<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAttributeValue extends Model
{
    use HasFactory;

    protected $fillable = ['attribute_id', 'value','price'];

    public function attribute()
    {
        return $this->belongsTo(ProductAttribute::class);
    }

}
