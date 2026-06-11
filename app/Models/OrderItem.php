<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id',
        'product_id',
        'product_name',
        'product_image',
        'qty',
        'price',
        'subtotal',
        'use_candle',
        'candle_1',
        'candle_2',
        'paper_bag',
        'request_tambahan',
    ];
}