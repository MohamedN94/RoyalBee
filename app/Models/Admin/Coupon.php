<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'discount', 'type', 'expiry_date'];

    public function isValid()
    {
        return $this->expiry_date === null || $this->expiry_date->isFuture();
    }

    public function applyDiscount($total)
    {
        if ($this->type === 'fixed') {
            return $total - $this->discount;
        } elseif ($this->type === 'percentage') {
            return $total - ($total * ($this->discount / 100));
        }

        return $total;
    }

}
