<?php

namespace App\Models\Admin;

use App\Models\PaymentAddress;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Payment extends Model
{

    protected $fillable = ['user_id', 'amount', 'payment_method', 'transaction_id','payment_status'];

    public function paymentAddress()
    {
        return $this->hasOne(PaymentAddress::class, 'payment_id');
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'payment_product', 'payment_id', 'product_id')
            ->withPivot('quantity', 'amount');
    }
}
