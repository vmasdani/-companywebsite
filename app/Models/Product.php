<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price_idr'
    ];

    protected $attributes = [
        'name' => 't',
        'description' => '',
        'price_idr' => 0.0
    ];

    // static function ($ob) {
    //     $new = new Product;
    //     $new->name = $ob->name;
    //     $new->name = $ob->name;
    //     $new->name = $ob->name;
        
    // }

    use HasFactory;
}
