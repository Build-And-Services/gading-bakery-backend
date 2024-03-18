<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $dates = ['created_at'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
