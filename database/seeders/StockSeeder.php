<?php

namespace Database\Seeders;

use App\Models\Stock;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 70; $i++) {
            Stock::create([
                'quantity' => 10,
                'type' => 'increase',
                'product_id' => $i,
            ]);
        }
    }
}
