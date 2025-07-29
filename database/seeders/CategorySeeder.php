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
        // First, create the main Fruits category
        $fruitsCategory = Category::firstOrCreate(
            ['slug' => 'fruits'],
            [
                'is_active' => true,
                'parent_id' => null, // Top level category
            ]
        );
        
        // Add translations for the main Fruits category
        $fruitsCategory->translateOrNew('en')->name = 'Fruits';
        $fruitsCategory->translateOrNew('en')->description = 'All types of fruits from around the world';
        
        $fruitsCategory->translateOrNew('th')->name = 'ผลไม้';
        $fruitsCategory->translateOrNew('th')->description = 'ผลไม้ทุกชนิดจากทั่วโลก';
        
        $fruitsCategory->translateOrNew('zh')->name = '水果';
        $fruitsCategory->translateOrNew('zh')->description = '来自世界各地的各种水果';
        
        $fruitsCategory->save();
        
        // Define subcategories
        $categories = [
            [
                'translations' => [
                    'en' => [
                        'name' => 'Tropical Fruits',
                        'description' => 'Exotic fruits from tropical regions',
                    ],
                    'th' => [
                        'name' => 'ผลไม้เขตร้อน',
                        'description' => 'ผลไม้แปลกใหม่จากภูมิภาคเขตร้อน',
                    ],
                    'zh' => [
                        'name' => '热带水果',
                        'description' => '来自热带地区的异国水果',
                    ]
                ],
                'slug' => 'tropical-fruits',
                'is_active' => true,
                'parent_id' => $fruitsCategory->id, // Child of main Fruits category
            ],
            [
                'translations' => [
                    'en' => [
                        'name' => 'Berries',
                        'description' => 'Sweet and tangy berries of all kinds',
                    ],
                    'th' => [
                        'name' => 'เบอร์รี่',
                        'description' => 'เบอร์รี่รสหวานและเปรี้ยวหลากหลายชนิด',
                    ],
                    'zh' => [
                        'name' => '浆果',
                        'description' => '各种甘甘酸酸的浆果',
                    ]
                ],
                'slug' => 'berries',
                'is_active' => true,
                'parent_id' => $fruitsCategory->id, // Child of main Fruits category
            ],
            [
                'translations' => [
                    'en' => [
                        'name' => 'Citrus',
                        'description' => 'Tangy and refreshing citrus fruits',
                    ],
                    'th' => [
                        'name' => 'ผลไม้ตระกูลส้ม',
                        'description' => 'ผลไม้ตระกูลส้มรสเปรี้ยวและสดชื่น',
                    ],
                    'zh' => [
                        'name' => '柿子类',
                        'description' => '酸爽的柿子类水果',
                    ]
                ],
                'slug' => 'citrus',
                'is_active' => true,
                'parent_id' => $fruitsCategory->id, // Child of main Fruits category
            ],
            [
                'translations' => [
                    'en' => [
                        'name' => 'Stone Fruits',
                        'description' => 'Fruits with a large pit or stone in the middle',
                    ],
                    'th' => [
                        'name' => 'ผลไม้ที่มีเมล็ดแข็ง',
                        'description' => 'ผลไม้ที่มีเมล็ดแข็งขนาดใหญ่ตรงกลาง',
                    ],
                    'zh' => [
                        'name' => '核果类',
                        'description' => '中间有大果核的水果',
                    ]
                ],
                'slug' => 'stone-fruits',
                'is_active' => true,
                'parent_id' => $fruitsCategory->id, // Child of main Fruits category
            ],
        ];

        foreach ($categories as $categoryData) {
            // Find existing category by slug or create a new one
            $category = Category::firstOrNew(['slug' => $categoryData['slug']]);
            $category->is_active = $categoryData['is_active'];
            $category->parent_id = $categoryData['parent_id']; // Set the parent_id
            $category->save();
            
            // Add translations
            foreach ($categoryData['translations'] as $locale => $translation) {
                $category->translateOrNew($locale)->name = $translation['name'];
                $category->translateOrNew($locale)->description = $translation['description'];
            }
            
            $category->save();
        }
        
        $this->command->info('Basic fruit categories created successfully!');
    }
}
