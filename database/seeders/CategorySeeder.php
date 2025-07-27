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
            ],
        ];

        foreach ($categories as $categoryData) {
            // Find existing category by slug or create a new one
            $category = Category::firstOrNew(['slug' => $categoryData['slug']]);
            $category->is_active = $categoryData['is_active'];
            $category->save();
            
            // Add translations
            foreach ($categoryData['translations'] as $locale => $translation) {
                $category->translateOrNew($locale)->name = $translation['name'];
                $category->translateOrNew($locale)->description = $translation['description'];
            }
            
            $category->save();
        }
    }
}
