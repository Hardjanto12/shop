<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;
    protected $fillable = ['order_item_serial_number', 'order_serial_number', 'product_id'];

    protected $table = 'order_items';

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_serial_number');

    }
    public function product()
    {
        return $this->belongsTo(Product::class);

    }
}