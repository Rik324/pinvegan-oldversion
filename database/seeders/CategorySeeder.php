<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Tropical Fruits',
                'description' => 'Exotic fruits from tropical regions',
                'is_active' => true,
            ],
            [
                'name' => 'Berries',
                'description' => 'Sweet and tangy berries of all kinds',
                'is_active' => true,
            ],
            [
                'name' => 'Citrus',
                'description' => 'Tangy and refreshing citrus fruits',
                'is_active' => true,
            ],
            [
                'name' => 'Stone Fruits',
                'description' => 'Fruits with a large pit or stone in the middle',
                'is_active' => true,
            ],
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate(
                ['name' => $category['name']],
                $category
            );
        }
    }
}
