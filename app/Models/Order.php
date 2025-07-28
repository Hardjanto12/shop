<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_serial_number',
        'user_id',
        'game_id',
        'server_num',
        'email',
        'status',
        'payment_id'
    ];

    protected $table = 'orders';

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class, 'order_serial_number', 'order_serial_number');
    }
}