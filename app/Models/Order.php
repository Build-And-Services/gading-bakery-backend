<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nominal'
    ];


    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function calculateTotalOrderPrice()
    {
        return $this->orderItems->sum(function ($orderItem) {
            return $orderItem->quantity * $orderItem->selling_price;
        });
    }
    public function calculateProfit()
    {
        return $this->orderItems->sum(function ($orderItem) {
            return $orderItem->quantity * ($orderItem->selling_price - $orderItem->purchase_price);
        });
    }
}
