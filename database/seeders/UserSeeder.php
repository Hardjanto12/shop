<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create(
            [
                'name' => 'Anastasya Yasmeen',
                'email' => 'yasmeen@mail.com',
                'password' => '12345678'
            ]
        );
        User::create(
            [
                'name' => 'Serafine',
                'email' => 'ppinponn@mail.com',
                'password' => '12345678'
            ]
        );
        User::create(
            [
                'name' => 'Nastasia Adeline',
                'email' => 'adeline@mail.com',
                'password' => '12345678'
            ]
        );
        User::create(
            [
                'name' => 'Hannalia Valentine',
                'email' => 'lelelent@mail.com',
                'password' => '12345678'
            ]
        );
    }
}