<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'remarks',
        'bought_price',
        'margin',
        'selling_price',
        'quantity',
        'unit',
    ];
}
