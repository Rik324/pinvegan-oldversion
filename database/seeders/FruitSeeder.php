<?php

namespace Database\Seeders;

use App\Models\Fruit;
use Illuminate\Database\Seeder;

class FruitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fruit = Fruit::create([
            'is_available' => true,
            'is_featured' => true,
            'category_id' => 1, // Tropical Fruits category
            'image' => 'mango.jpg',
            'price' => 2.99
        ]);

        // Add translations
        $fruit->translateOrNew('en')->name = 'Mango';
        $fruit->translateOrNew('en')->description = 'Sweet tropical fruit with a large pit';
        $fruit->translateOrNew('en')->origin = 'Thailand';
        $fruit->translateOrNew('en')->seasonality = 'Summer';

        $fruit->translateOrNew('th')->name = 'มะม่วง';
        $fruit->translateOrNew('th')->description = 'ผลไม้เขตร้อนรสหวานที่มีเมล็ดขนาดใหญ่';
        $fruit->translateOrNew('th')->origin = 'ประเทศไทย';
        $fruit->translateOrNew('th')->seasonality = 'ฤดูร้อน';

        $fruit->translateOrNew('zh')->name = '芒果';
        $fruit->translateOrNew('zh')->description = '带有大核的甜热带水果';
        $fruit->translateOrNew('zh')->origin = '泰国';
        $fruit->translateOrNew('zh')->seasonality = '夏季';

        $fruit->save();

        // Add another fruit
        $fruit = Fruit::create([
            'is_available' => true,
            'is_featured' => false,
            'category_id' => 1, // Tropical Fruits category
            'image' => 'banana.jpg',
            'price' => 1.99
        ]);

        // Add translations
        $fruit->translateOrNew('en')->name = 'Banana';
        $fruit->translateOrNew('en')->description = 'Elongated curved fruit with a yellow skin';
        $fruit->translateOrNew('en')->origin = 'Thailand';
        $fruit->translateOrNew('en')->seasonality = 'Year-round';

        $fruit->translateOrNew('th')->name = 'กล้วย';
        $fruit->translateOrNew('th')->description = 'ผลไม้ทรงยาวโค้งมีเปลือกสีเหลือง';
        $fruit->translateOrNew('th')->origin = 'ประเทศไทย';
        $fruit->translateOrNew('th')->seasonality = 'ตลอดปี';

        $fruit->translateOrNew('zh')->name = '香蕉';
        $fruit->translateOrNew('zh')->description = '带有黄色皮的细长弯曲水果';
        $fruit->translateOrNew('zh')->origin = '泰国';
        $fruit->translateOrNew('zh')->seasonality = '全年';

        $fruit->save();
    }
}