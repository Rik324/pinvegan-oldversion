<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Fruit;
use Illuminate\Database\Seeder;

class FruitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get category IDs for reference
        $tropical = Category::where('name', 'Tropical Fruits')->first()?->id;
        $berries = Category::where('name', 'Berries')->first()?->id;
        $citrus = Category::where('name', 'Citrus')->first()?->id;
        $stone = Category::where('name', 'Stone Fruits')->first()?->id;
        
        $fruits = [
            [
                'name' => 'Mango',
                'description' => 'Sweet and juicy tropical fruit with a large seed in the middle.',
                'origin' => 'India and Southeast Asia',
                'taste_profile' => 'Sweet with slight tartness',
                'seasonality' => 'Summer',
                'price' => 2.99,
                'is_available' => true,
                'is_featured' => true,
                'category_id' => $tropical,
            ],
            [
                'name' => 'Strawberry',
                'description' => 'Sweet, heart-shaped berries with tiny seeds on the surface.',
                'origin' => 'Europe and Americas',
                'taste_profile' => 'Sweet and slightly tart',
                'seasonality' => 'Spring to early Summer',
                'price' => 3.49,
                'is_available' => true,
                'is_featured' => true,
                'category_id' => $berries,
            ],
            [
                'name' => 'Orange',
                'description' => 'Round citrus fruit with a tough bright reddish-orange peel.',
                'origin' => 'China',
                'taste_profile' => 'Sweet and tangy',
                'seasonality' => 'Winter to Spring',
                'price' => 1.29,
                'is_available' => true,
                'is_featured' => false,
                'category_id' => $citrus,
            ],
            [
                'name' => 'Peach',
                'description' => 'Soft, juicy fruit with fuzzy skin and a large stone in the center.',
                'origin' => 'China',
                'taste_profile' => 'Sweet and fragrant',
                'seasonality' => 'Summer',
                'price' => 1.99,
                'is_available' => true,
                'is_featured' => false,
                'category_id' => $stone,
            ],
            [
                'name' => 'Pineapple',
                'description' => 'Tropical fruit with a tough, spiky exterior and sweet interior.',
                'origin' => 'South America',
                'taste_profile' => 'Sweet and tangy',
                'seasonality' => 'Year-round (peak in Spring)',
                'price' => 4.99,
                'is_available' => true,
                'is_featured' => true,
                'category_id' => $tropical,
            ],
            [
                'name' => 'Blueberry',
                'description' => 'Small, round berries with a dark blue color and sweet taste.',
                'origin' => 'North America',
                'taste_profile' => 'Sweet with mild acidity',
                'seasonality' => 'Summer',
                'price' => 3.99,
                'is_available' => true,
                'is_featured' => false,
                'category_id' => $berries,
            ],
        ];

        foreach ($fruits as $fruit) {
            Fruit::firstOrCreate(
                ['name' => $fruit['name']],
                $fruit
            );
        }
    }
}
