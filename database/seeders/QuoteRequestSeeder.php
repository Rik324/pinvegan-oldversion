<?php

namespace Database\Seeders;
use App\Models\QuoteRequest;
use App\Models\Fruit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuoteRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a couple of quote requests
        $quote1 = QuoteRequest::create([
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'phone' => '123-456-7890',
            'message' => 'Looking for a quote for an upcoming party.',
            'status' => 'new',
        ]);

        $quote2 = QuoteRequest::create([
            'name' => 'Jane Smith',
            'email' => 'jane.smith@example.com',
            'phone' => '098-765-4321',
            'message' => 'Need a weekly supply of fresh fruits for my office.',
            'status' => 'new',
        ]);

        // Get some random fruits to attach to the quote requests
        $fruits1 = Fruit::inRandomOrder()->take(3)->get();
        $fruits2 = Fruit::inRandomOrder()->take(2)->get();

        // Attach fruits to the first quote request with random quantities
        if ($fruits1->count() > 0) {
            foreach ($fruits1 as $fruit) {
                $quote1->fruits()->attach($fruit->id, ['quantity' => rand(1, 5)]);
            }
        }

        // Attach fruits to the second quote request with random quantities
        if ($fruits2->count() > 0) {
            foreach ($fruits2 as $fruit) {
                $quote2->fruits()->attach($fruit->id, ['quantity' => rand(2, 6)]);
            }
        }
    }
}