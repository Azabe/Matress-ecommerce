<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Order extends Model
{
    use HasFactory;

    const STATUSES = ['CREATED', 'PENDING', 'PROCESSING', 'APPROVED', 'CANCELED'];

    const PAYMENT_STATUSES = ['PAID', 'UNPAID'];

    const PAID = self::PAYMENT_STATUSES[0];
    const UNPAID = self::PAYMENT_STATUSES[1];

    const CREATED = self::STATUSES[0];
    const PENDING = self::STATUSES[1];
    const PROCESSING = self::STATUSES[2];
    const APPROVED = self::STATUSES[3];
    const CANCELED = self::STATUSES[4];

    protected $fillable = [
        'id', 'user_id', 'code', 'status', 'delivery_date', 'payment_status'
    ];

    protected $casts = [
        'id' => 'string',
        'user_id' => 'string'
    ];

    /**
     * Get the user that owns the Order
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * The products that belong to the Order
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'order__products', 'order_id', 'product_id')->withPivot('quantity', 'total_price');
    }

    public function renderOrderStatusBadge(): string
    {
        switch ($this->status) {
            case 'CREATED':
                return 'primary';
                break;
            case 'PENDING':
                return 'secondary';
                break;
            case 'PROCESSING':
                return 'info';
                break;
            case 'APPROVED':
                return 'success';
                break;
            case 'CANCELED':
                return 'danger';
                break;
            
            default:
                # code...
                break;
        }
    }
    public function renderOrderPaymentStatusBadge(): string
    {
        switch ($this->payment_status) {
            case 'PAID':
                return 'success';
                break;
            case 'UNPAID':
                return 'danger';
                break;
            
            default:
                # code...
                break;
        }
    }
}
