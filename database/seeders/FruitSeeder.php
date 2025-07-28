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
        // 1. Mango
        $fruit = Fruit::create([
            'is_available' => true,
            'is_featured' => true,
            'category_id' => 1, // Tropical Fruits category
            'image' => 'images/fruits/mango.png',
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

        // 2. Banana
        $fruit = Fruit::create([
            'is_available' => true,
            'is_featured' => true,
            'category_id' => 1, // Tropical Fruits category
            'image' => 'images/fruits/banana.png',
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
        
        // 3. Durian
        $fruit = Fruit::create([
            'is_available' => true,
            'is_featured' => true,
            'category_id' => 1, // Tropical Fruits category
            'image' => 'images/fruits/durian.png',
            'price' => 15.99
        ]);

        // Add translations
        $fruit->translateOrNew('en')->name = 'Durian';
        $fruit->translateOrNew('en')->description = 'The king of fruits with a strong aroma and custard-like flesh';
        $fruit->translateOrNew('en')->origin = 'Thailand';
        $fruit->translateOrNew('en')->seasonality = 'May to August';

        $fruit->translateOrNew('th')->name = 'ทุเรียน';
        $fruit->translateOrNew('th')->description = 'ราชาแห่งผลไม้ที่มีกลิ่นแรงและเนื้อคล้ายคัสตาร์ด';
        $fruit->translateOrNew('th')->origin = 'ประเทศไทย';
        $fruit->translateOrNew('th')->seasonality = 'พฤษภาคม ถึง สิงหาคม';

        $fruit->translateOrNew('zh')->name = '榴莲';
        $fruit->translateOrNew('zh')->description = '水果之王，具有浓郁香气和奶油般的果肉';
        $fruit->translateOrNew('zh')->origin = '泰国';
        $fruit->translateOrNew('zh')->seasonality = '五月至八月';

        $fruit->save();
        
        // 4. Orange
        $fruit = Fruit::create([
            'is_available' => true,
            'is_featured' => true,
            'category_id' => 2, // Citrus Fruits category (assuming category_id 2 is for Citrus)
            'image' => 'images/fruits/orange.png',
            'price' => 1.49
        ]);

        // Add translations
        $fruit->translateOrNew('en')->name = 'Orange';
        $fruit->translateOrNew('en')->description = 'Juicy citrus fruit with a sweet and tangy flavor';
        $fruit->translateOrNew('en')->origin = 'China';
        $fruit->translateOrNew('en')->seasonality = 'Winter to Spring';

        $fruit->translateOrNew('th')->name = 'ส้ม';
        $fruit->translateOrNew('th')->description = 'ผลไม้ตระกูลส้มที่มีรสหวานอมเปรี้ยว';
        $fruit->translateOrNew('th')->origin = 'จีน';
        $fruit->translateOrNew('th')->seasonality = 'ฤดูหนาวถึงฤดูใบไม้ผลิ';

        $fruit->translateOrNew('zh')->name = '橙子';
        $fruit->translateOrNew('zh')->description = '多汁的柑橘类水果，带有甜酸口味';
        $fruit->translateOrNew('zh')->origin = '中国';
        $fruit->translateOrNew('zh')->seasonality = '冬季至春季';

        $fruit->save();
    }
}