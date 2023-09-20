<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'order_id', 'product_id', 'quantity', 'total_price'
    ];

    protected $casts = [
        'id' => 'string',
        'order_id' => 'string',
        'product_id' => 'string'
    ];
}
