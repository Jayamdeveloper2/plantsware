<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model {
    use HasFactory;

    protected $fillable = [
        'order_number', 'user_id', 'shipping_address', 'subtotal', 'shipping', 'tax', 'total',
        'status', 'payment_status', 'payment_method'
    ];

    protected $casts = ['shipping_address' => 'array'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function items() {
        return $this->hasMany(OrderItem::class);
    }

    // Helper for badge class (as in your OrderController)
    public function getStatusBadgeClass() {
        return [
            'pending' => 'bg-warning text-dark',
            'processing' => 'bg-info text-dark',
            'shipped' => 'bg-primary',
            'delivered' => 'bg-success',
            'cancelled' => 'bg-danger',
        ][$this->status] ?? 'bg-secondary';
    }
}
