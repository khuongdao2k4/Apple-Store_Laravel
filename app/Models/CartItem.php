<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    protected $table = 'cart_items';

    protected $fillable = [
        'email',
        'product_name',
        'price',
        'storage',
        'color',
        'image_url',
        'quantity',
    ];
}
