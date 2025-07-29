<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Fruit;
use Illuminate\Support\Str;

class CategoryFruitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Thai Products (top level category)
        $thaiProducts = Category::create([
            'slug' => 'thai-products',
            'is_active' => true,
            'parent_id' => null, // Top level category
        ]);
        
        // Add translations for Thai Products
        $thaiProducts->translateOrNew('en')->name = 'Thai Products';
        $thaiProducts->translateOrNew('en')->description = 'Products from Thailand';
        $thaiProducts->translateOrNew('th')->name = 'สินค้าไทย';
        $thaiProducts->translateOrNew('th')->description = 'สินค้าจากประเทศไทย';
        $thaiProducts->save();
        
        // Create Thai Fruits (sub-category of Thai Products)
        $thaiFruits = Category::create([
            'slug' => 'thai-fruits',
            'is_active' => true,
            'parent_id' => $thaiProducts->id, // Child of Thai Products
        ]);
        
        // Add translations for Thai Fruits
        $thaiFruits->translateOrNew('en')->name = 'Thai Fruits';
        $thaiFruits->translateOrNew('en')->description = 'Delicious fruits from Thailand';
        $thaiFruits->translateOrNew('th')->name = 'ผลไม้ไทย';
        $thaiFruits->translateOrNew('th')->description = 'ผลไม้อร่อยจากประเทศไทย';
        $thaiFruits->save();
        
        // Create Mangosteen (a fruit in the Thai Fruits category)
        $mangosteen = Fruit::create([
            'is_available' => true,
            'is_featured' => true,
            'category_id' => $thaiFruits->id,
            'image' => 'mangosteen.jpg',
            'price' => 120.00,
        ]);
        
        // Add translations for Mangosteen
        $mangosteen->translateOrNew('en')->name = 'Mangosteen';
        $mangosteen->translateOrNew('en')->description = 'Queen of fruits with sweet and tangy flavor';
        $mangosteen->translateOrNew('en')->origin = 'Eastern Thailand';
        $mangosteen->translateOrNew('en')->seasonality = 'May to September';
        
        $mangosteen->translateOrNew('th')->name = 'มังคุด';
        $mangosteen->translateOrNew('th')->description = 'ราชินีแห่งผลไม้ รสชาติหวานอมเปรี้ยว';
        $mangosteen->translateOrNew('th')->origin = 'ภาคตะวันออกของไทย';
        $mangosteen->translateOrNew('th')->seasonality = 'พฤษภาคมถึงกันยายน';
        $mangosteen->save();
        
        $this->command->info('Hierarchical categories and fruit created successfully!');
    }
}
