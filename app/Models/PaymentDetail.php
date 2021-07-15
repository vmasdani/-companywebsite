<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentDetail extends Model
{
    protected $fillable =  [
        'id',
        'amount',
        'payment_id'
    ];

    protected $attributes = [
        'id' => null,
        'amount' => 0,
        'payment_id' => null
    ];

    use HasFactory;
}
