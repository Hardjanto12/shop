<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'order_serial_number');
    }
}