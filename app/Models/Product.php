<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;

    const SIZES = ['KING', 'QUEEN', 'SINGLE', 'BABY'];
    const TYPES = ['LALA SALAMA', 'SWEET DREAMS'];
    const STATUS = ['IN STOCK', 'OUT OF STOCK'];

    const KINGSIZE = self::SIZES[0];
    const QUEENSIZE = self::SIZES[1];
    const SINGLESIZE = self::SIZES[2];
    const BABYSIZE = self::SIZES[3];

    const LALASALAMA = self::TYPES[0];
    const SWEETDREAMS = self::TYPES[1];

    protected $fillable = [
        'id',
        'image',
        'description',
        'size',
        'height',
        'width',
        'length',
        'type',
        'price',
        'quantity',
    ];

    protected $casts = [
        'id' => 'string'
    ];

    /**
     * The carts that belong to the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function carts(): BelongsToMany
    {
        return $this->belongsToMany(Cart::class, 'cart__products', 'product_id', 'cart_id');
    }

    /**
     * The orders that belong to the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class, 'order__products', 'product_id', 'order_id')->withPivot('quantity', 'total_price');
    }
}
