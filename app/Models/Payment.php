<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable =  [
        'id',
        'amount',
        'months',
        'note',
        'user_id',
        'date',
        'years'
    ];

    protected $attributes = [
        'id' => null,
        'amount' => 0,
        'months' => 0,
        'note' => '',
        'userId' => 0,
        'user_id' => null,
        'date' => null,
        'years' => 0
    ];

    use HasFactory;
}
