<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'order_number', 'status', 'subtotal', 'tax', 'shipping',
        'discount', 'total', 'payment_method', 'payment_status', 'stripe_payment_intent_id',
        'shipping_address', 'billing_address', 'notes', 'shipped_at', 'delivered_at',
    ];

    protected $casts = [
        'subtotal'         => 'decimal:2',
        'tax'              => 'decimal:2',
        'shipping'         => 'decimal:2',
        'discount'         => 'decimal:2',
        'total'            => 'decimal:2',
        'shipping_address' => 'array',
        'billing_address'  => 'array',
        'shipped_at'       => 'datetime',
        'delivered_at'     => 'datetime',
    ];

    const STATUSES = ['pending', 'processing', 'shipped', 'delivered', 'cancelled', 'refunded'];
    const PAYMENT_STATUSES = ['pending', 'paid', 'failed', 'refunded'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    protected static function booted()
    {
        static::creating(function ($order) {
            $order->order_number = 'ORD-' . strtoupper(uniqid());
        });
    }
}
