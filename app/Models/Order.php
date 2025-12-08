<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_number',
        'total_amount',
        'status',
        'payment_status',
        'recipient_name',
        'phone_number',
        'address',
        'shipping_address',
        'shipping_city',
        'shipping_province',
        'shipping_postal_code',
        'phone',
        'notes',
        'payment_method',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the user that placed the order.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the items for this order.
     */
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Generate unique order number
     */
    public static function generateOrderNumber()
    {
        $lastOrder = self::latest('id')->first();
        $nextNumber = ($lastOrder ? (int)substr($lastOrder->order_number, -6) : 0) + 1;
        return 'ORD-' . now()->format('Ymd') . '-' . str_pad($nextNumber, 6, '0', STR_PAD_LEFT);
    }
}
