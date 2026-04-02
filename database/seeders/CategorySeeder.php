<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Adventure',
                'slug' => 'adventure',
                'icon' => 'fa-mountain-sun',
                'color' => '#FF6B6B',
            ],
            [
                'name' => 'Culture',
                'slug' => 'culture',
                'icon' => 'fa-landmark',
                'color' => '#F4A261',
            ],
            [
                'name' => 'Food',
                'slug' => 'food',
                'icon' => 'fa-utensils',
                'color' => '#2EC4B6',
            ],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(['slug' => $category['slug']], $category);
        }
    }
}
