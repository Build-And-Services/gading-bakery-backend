<?php

namespace Database\Seeders;

use App\Models\OrderItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        OrderItem::create([
            'product_id' => 1,
            'order_id' => 1,
            'quantity' => 4,
        ]);
        OrderItem::create([
            'product_id' => 1,
            'order_id' => 1,
            'quantity' => 7,
        ]);
    }
}
