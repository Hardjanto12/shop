<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_item_serial_number',
        'order_serial_number',
        'product_code'
    ];

    protected $table = 'order_items';

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'order_serial_number');

    }
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_code', 'product_serial_number');

    }
}