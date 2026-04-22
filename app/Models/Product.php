<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    
    // Legacy schema has no updated_at
    const UPDATED_AT = null;

    protected $fillable = [
        'name',
        'series',
        'series_title',
        'series_image',
        'image_url',
        'colors',
        'price',
        'quantity',
        'sort_order',
    ];
}
