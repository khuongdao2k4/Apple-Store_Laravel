<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';
    protected $primaryKey = 'id_order';

    // Legacy schema has no updated_at
    const UPDATED_AT = null;

    protected $fillable = [
        'username',
        'email',
        'product',
        'image_url',
        'storage',
        'color',
        'price',
        'phone',
        'address',
        'payment_method',
        'status',
        'vnp_transaction_no',
        'vnp_response_code',
    ];
}
