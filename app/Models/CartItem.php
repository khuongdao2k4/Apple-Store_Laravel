<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Traits\ResolvesColors;

class CartItem extends Model
{
    use HasFactory, ResolvesColors;
    protected $table = 'cart_items';

    protected $fillable = [
        'email',
        'product_name',
        'price',
        'storage',
        'color',
        'image_url',
        'quantity',
        'applecare',
    ];

    protected $casts = [
        'applecare' => 'boolean',
    ];
}
