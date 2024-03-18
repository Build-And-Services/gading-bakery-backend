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

        $image = $faker->image('public/images/categories', 640, 480, null, false);
        Category::create([
            'name' => $faker->name,
            'image' => 'https://stagging.gading-bakery.com/images/categories/' . $image,
        ]);
    }
}
