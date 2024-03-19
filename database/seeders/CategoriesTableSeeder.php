<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create(['name' => 'Mobile Legends', 'slug' => 'mobile-legends', 'pics' => 'mole']);
        Category::create(['name' => 'PUBG Mobile', 'slug' => 'pubg-mobile', 'pics' => 'pubg']);
        Category::create(['name' => 'Valorant', 'slug' => 'valorant', 'pics' => 'valo']);
        Category::create(['name' => 'Free Fire', 'slug' => 'free-fire', 'pics' => 'ff']);
        Category::create(['name' => 'Point Blank', 'slug' => 'point-blank', 'pics' => 'pb']);
    }
}