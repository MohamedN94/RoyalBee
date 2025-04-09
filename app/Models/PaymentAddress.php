<?php

namespace App\Models;

use App\Models\Admin\Payment;
use Illuminate\Database\Eloquent\Model;

class PaymentAddress extends Model
{
    protected $fillable = ['first_name', 'last_name', 'phone', 'email', 'postal_code', 'street_address', 'country', 'region','payment_id','emirate'];

    public function payment()
    {
        return $this->belongsTo(Payment::class, 'payment_id');
    }
}
