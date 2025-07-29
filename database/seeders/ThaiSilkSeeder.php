<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Fruit;

class ThaiSilkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Find the existing Thai Products category
        $thaiProducts = Category::where('slug', 'thai-products')->first();
        
        if (!$thaiProducts) {
            $this->command->error('Thai Products category not found. Please run CategoryFruitSeeder first.');
            return;
        }
        
        // Create Thai Silk subcategory
        $thaiSilk = Category::create([
            'slug' => 'thai-silk',
            'is_active' => true,
            'parent_id' => $thaiProducts->id, // Child of Thai Products
        ]);
        
        // Add translations for Thai Silk
        $thaiSilk->translateOrNew('en')->name = 'Thai Silk';
        $thaiSilk->translateOrNew('en')->description = 'Traditional Thai silk products';
        
        $thaiSilk->translateOrNew('th')->name = 'ผ้าไหมไทย';
        $thaiSilk->translateOrNew('th')->description = 'ผลิตภัณฑ์ผ้าไหมไทยแบบดั้งเดิม';
        
        $thaiSilk->translateOrNew('zh')->name = '泰国丝绸';
        $thaiSilk->translateOrNew('zh')->description = '传统泰国丝绸产品';
        
        $thaiSilk->save();
        
        // Create Esan Silk subcategory
        $esanSilk = Category::create([
            'slug' => 'esan-silk',
            'is_active' => true,
            'parent_id' => $thaiProducts->id, // Child of Thai Products
        ]);
        
        // Add translations for Esan Silk
        $esanSilk->translateOrNew('en')->name = 'Esan Silk';
        $esanSilk->translateOrNew('en')->description = 'Silk products from Northeastern Thailand (Esan region)';
        
        $esanSilk->translateOrNew('th')->name = 'ผ้าไหมอีสาน';
        $esanSilk->translateOrNew('th')->description = 'ผลิตภัณฑ์ผ้าไหมจากภาคตะวันออกเฉียงเหนือของไทย (อีสาน)';
        
        $esanSilk->translateOrNew('zh')->name = '伊桑丝绸';
        $esanSilk->translateOrNew('zh')->description = '来自泰国东北部（伊桑地区）的丝绸产品';
        
        $esanSilk->save();
        
        // Add a sample product for Thai Silk
        $silkScarf = new Fruit();
        $silkScarf->is_available = true;
        $silkScarf->is_featured = true;
        $silkScarf->category_id = $thaiSilk->id;
        $silkScarf->image = 'thai-silk-scarf.jpg'; // Placeholder image name
        $silkScarf->price = 850.00;
        $silkScarf->save();
        
        // Add translations for the silk scarf
        $silkScarf->translateOrNew('en')->name = 'Thai Silk Scarf';
        $silkScarf->translateOrNew('en')->description = 'Handcrafted silk scarf made with traditional Thai techniques';
        $silkScarf->translateOrNew('en')->origin = 'Central Thailand';
        $silkScarf->translateOrNew('en')->seasonality = 'All year';
        
        $silkScarf->translateOrNew('th')->name = 'ผ้าพันคอไหมไทย';
        $silkScarf->translateOrNew('th')->description = 'ผ้าพันคอไหมทำด้วยมือด้วยเทคนิคแบบไทยดั้งเดิม';
        $silkScarf->translateOrNew('th')->origin = 'ภาคกลางของไทย';
        $silkScarf->translateOrNew('th')->seasonality = 'ตลอดทั้งปี';
        
        $silkScarf->translateOrNew('zh')->name = '泰国丝巾';
        $silkScarf->translateOrNew('zh')->description = '使用传统泰国技术手工制作的丝巾';
        $silkScarf->translateOrNew('zh')->origin = '泰国中部';
        $silkScarf->translateOrNew('zh')->seasonality = '全年';
        
        $silkScarf->save();
        
        // Add a sample product for Esan Silk
        $silkShawl = new Fruit();
        $silkShawl->is_available = true;
        $silkShawl->is_featured = false;
        $silkShawl->category_id = $esanSilk->id;
        $silkShawl->image = 'esan-silk-shawl.jpg'; // Placeholder image name
        $silkShawl->price = 1200.00;
        $silkShawl->save();
        
        // Add translations for the silk shawl
        $silkShawl->translateOrNew('en')->name = 'Esan Silk Shawl';
        $silkShawl->translateOrNew('en')->description = 'Traditional Esan silk shawl with unique Northeastern Thai patterns';
        $silkShawl->translateOrNew('en')->origin = 'Northeastern Thailand';
        $silkShawl->translateOrNew('en')->seasonality = 'All year';
        
        $silkShawl->translateOrNew('th')->name = 'ผ้าคลุมไหลผ้าไหมอีสาน';
        $silkShawl->translateOrNew('th')->description = 'ผ้าคลุมไหล่ไหมอีสานแบบดั้งเดิมพร้อมลวดลายเฉพาะของภาคตะวันออกเฉียงเหนือของไทย';
        $silkShawl->translateOrNew('th')->origin = 'ภาคตะวันออกเฉียงเหนือของไทย';
        $silkShawl->translateOrNew('th')->seasonality = 'ตลอดทั้งปี';
        
        $silkShawl->translateOrNew('zh')->name = '伊桑丝绸披肩';
        $silkShawl->translateOrNew('zh')->description = '传统伊桑丝绸披肩，带有泰国东北部独特图案';
        $silkShawl->translateOrNew('zh')->origin = '泰国东北部';
        $silkShawl->translateOrNew('zh')->seasonality = '全年';
        
        $silkShawl->save();
        
        $this->command->info('Thai Silk and Esan Silk categories with products created successfully!');
    }
}
