<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        $image = $faker->image('public/images/profiles', 640, 480, null, false);
        User::create(
            [
                'name' => 'Owner',
                'email' => 'owner@mail.com',
                'image' => url("/images/profiles/{$image}"),
                'password' => bcrypt('iniowner'),
                'role' => 'owner'
            ],
        );
        User::create(
            [
                'name' => 'Admin',
                'email' => 'admin@mail.com',
                'image' => url("/images/profiles/{$image}"),
                'password' => bcrypt('iniadmin'),
                'role' => 'admin'
            ]
        );
        User::create(
            [
                'name' => 'Cashier',
                'email' => 'cashier@mail.com',
                'image' => url("/images/profiles/{$image}"),
                'password' => bcrypt('inicashier'),
                'role' => 'cashier',
            ]
        );
    }
}
