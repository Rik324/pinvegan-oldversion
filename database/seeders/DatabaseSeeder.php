<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user if it doesn't exist
        User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
            ]
        );

        // Run seeders in the correct order (categories first, then fruits)
        $this->call([
            CategorySeeder::class,
            FruitSeeder::class,
            QuoteRequestSeeder::class,
            CategoryFruitSeeder::class, // Thai Products hierarchy with Thai Fruits
            ChineseCategorySeeder::class, // Chinese Products hierarchy
            ThaiSilkSeeder::class, // Thai Silk and Esan Silk categories
        ]);
    }
}
