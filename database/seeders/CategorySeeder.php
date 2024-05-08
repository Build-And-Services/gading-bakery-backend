<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        $bakeryImg = $faker->image('public/images/categories', 640, 480, null, false);
        Category::create([
            'name' => 'Bakery',
            'image' => url("/images/categories/{$bakeryImg}")
        ]);

        $kueBasahImg = $faker->image('public/images/categories', 640, 480, null, false);
        Category::create([
            'name' => 'Kue Basah',
            'image' => url("/images/categories/{$kueBasahImg}")
        ]);

        $cakeImg = $faker->image('public/images/categories', 640, 480, null, false);
        Category::create([
            'name' => 'Cake',
            'image' => url("/images/categories/{$cakeImg}")
        ]);

        $donutsImg = $faker->image('public/images/categories', 640, 480, null, false);
        Category::create([
            'name' => 'Donuts',
            'image' => url("/images/categories/{$donutsImg}")
        ]);
    }
}
