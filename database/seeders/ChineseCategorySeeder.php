<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class ChineseCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Chinese Products parent category
        $chineseProducts = Category::create([
            'slug' => 'chinese-products',
            'is_active' => true,
            'parent_id' => null,
        ]);
        
        // Add translations for Chinese Products
        $chineseProducts->translateOrNew('en')->name = 'Chinese Products';
        $chineseProducts->translateOrNew('en')->description = 'Products from China';
        
        $chineseProducts->translateOrNew('th')->name = 'สินค้าจีน';
        $chineseProducts->translateOrNew('th')->description = 'สินค้าจากประเทศจีน';
        
        $chineseProducts->translateOrNew('zh')->name = '中国产品';
        $chineseProducts->translateOrNew('zh')->description = '来自中国的产品';
        
        $chineseProducts->save();
        
        // Create Chinese Fruits child category
        $chineseFruits = Category::create([
            'slug' => 'chinese-fruits',
            'is_active' => true,
            'parent_id' => $chineseProducts->id,
        ]);
        
        // Add translations for Chinese Fruits
        $chineseFruits->translateOrNew('en')->name = 'Chinese Fruits';
        $chineseFruits->translateOrNew('en')->description = 'Fruits from China';
        
        $chineseFruits->translateOrNew('th')->name = 'ผลไม้จีน';
        $chineseFruits->translateOrNew('th')->description = 'ผลไม้จากประเทศจีน';
        
        $chineseFruits->translateOrNew('zh')->name = '中国水果';
        $chineseFruits->translateOrNew('zh')->description = '来自中国的水果';
        
        $chineseFruits->save();
        
        // Create Logan fruit
        $logan = new \App\Models\Fruit();
        $logan->is_available = true;
        $logan->is_featured = true;
        $logan->category_id = $chineseFruits->id;
        $logan->image = 'logan.jpg'; // Placeholder image name
        $logan->price = 120.00; // Price per kg
        $logan->save();
        
        // Add translations for Logan fruit
        $logan->translateOrNew('en')->name = 'Logan';
        $logan->translateOrNew('en')->description = 'Sweet and juicy logan fruit from China';
        $logan->translateOrNew('en')->origin = 'China';
        $logan->translateOrNew('en')->seasonality = 'Summer';
        
        $logan->translateOrNew('th')->name = 'ลำไย';
        $logan->translateOrNew('th')->description = 'ลำไยหวานฉ่ำจากประเทศจีน';
        $logan->translateOrNew('th')->origin = 'จีน';
        $logan->translateOrNew('th')->seasonality = 'ฤดูร้อน';
        
        $logan->translateOrNew('zh')->name = '桂圆';
        $logan->translateOrNew('zh')->description = '来自中国的甜美多汁的桂圆';
        $logan->translateOrNew('zh')->origin = '中国';
        $logan->translateOrNew('zh')->seasonality = '夏季';
        
        $logan->save();
    }
}
