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
                'password' => 'yasmeen'
            ]
        );
        User::create(
            [
                'name' => 'Serafine',
                'email' => 'ppinponn@mail.com',
                'password' => 'yasmeen'
            ]
        );
        User::create(
            [
                'name' => 'Nastasia Adeline',
                'email' => 'adeline@mail.com',
                'password' => 'adeline'
            ]
        );
        User::create(
            [
                'name' => 'Hannalia Valentine',
                'email' => 'lelelent@mail.com',
                'password' => 'lelelelent'
            ]
        );
    }
}