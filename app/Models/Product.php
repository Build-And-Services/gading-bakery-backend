<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function stocks()
    {
        return $this->hasMany(Stock::class);
    }

    public function getTotalIncreaseQuantity()
    {
        return $this->stocks()->where('type', 'increase')->sum('quantity');
    }

    public function getTotalDecreaseQuantity()
    {
        return $this->stocks()->where('type', 'decrease')->sum('quantity');
    }
    public function getTotalQuantity()
    {
        return $this->getTotalIncreaseQuantity() - $this->getTotalDecreaseQuantity();
    }
}
