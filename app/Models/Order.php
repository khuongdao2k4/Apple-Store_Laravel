<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Traits\ResolvesColors;

class Order extends Model
{
    use HasFactory, ResolvesColors;

    protected $table = 'orders';
    protected $primaryKey = 'id_order';

    // Legacy schema has no updated_at
    const UPDATED_AT = null;

    protected $fillable = [
        'username',
        'email',
        'product',
        'items',
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

    protected $appends = ['status_label'];

    public function getStatusLabelAttribute()
    {
        $map = [
            'pending'   => 'Chờ xử lý',
            'paid'      => 'Đã thanh toán',
            'shipped'   => 'Đang giao hàng',
            'completed' => 'Hoàn thành',
            'failed'    => 'Thất bại',
        ];
        return $map[strtolower($this->status)] ?? $this->status;
    }


    protected $casts = [
        'items' => 'array',
    ];
}
