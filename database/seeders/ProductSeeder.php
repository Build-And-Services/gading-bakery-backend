<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        $image = $faker->image('public/images/products', 640, 480, null, false);

        Product::create([
            'name' => $faker->name,
            'image' => url("/images/categories/{$image}"),
            'product_code' => '0000001sX',
            'purchase_price' => 8000,
            'selling_price' => 10000,
            'category_id' => 1
        ]);
    }
}
