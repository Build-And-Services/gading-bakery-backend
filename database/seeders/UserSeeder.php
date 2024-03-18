<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create(
            [
                'name' => 'Owner',
                'email' => 'owner@mail.com',
                'image' => '/user/[number-date]-image.js',
                'password' => bcrypt('iniowner'),
                'role' => 'owner'
            ],
        );
        User::create(
            [
                'name' => 'Admin',
                'email' => 'admin@mail.com',
                'image' => '/user/[number-date]-image.js',
                'password' => bcrypt('iniadmin'),
                'role' => 'admin'
            ]
        );
        User::create(
            [
                'name' => 'Cashier',
                'email' => 'cashier@mail.com',
                'image' => '/user/[number-date]-image.js',
                'password' => bcrypt('inicashier'),
                'role' => 'cashier',
            ]
        );
    }
}
