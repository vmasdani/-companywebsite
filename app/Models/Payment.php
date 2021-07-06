<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable =  [
        'id',
        'amount',
        'note',
        'user_id'
    ];

    use HasFactory;
}
