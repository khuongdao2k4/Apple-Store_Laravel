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

    protected $appends = ['numeric_price'];

    public function getNumericPriceAttribute()
    {
        // Remove non-numeric characters and cast to float
        return (float)preg_replace('/[^0-9]/', '', $this->price);
    }

    public function options()
    {
        return $this->hasMany(ProductOption::class)->orderBy('sort_order', 'asc');
    }
}
