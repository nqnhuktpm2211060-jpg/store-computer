<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Category;

class OptimizeProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Dữ liệu mẫu cho cửa hàng máy tính/laptop
        $categories = [
            ['id' => 1, 'name' => 'Laptop Gaming', 'parent_id' => 0, 'level' => 1, 'icon' => 'gaming'],
            ['id' => 2, 'name' => 'Laptop Văn Phòng', 'parent_id' => 0, 'level' => 1, 'icon' => 'office'],
            ['id' => 3, 'name' => 'Laptop Đồ Họa', 'parent_id' => 0, 'level' => 1, 'icon' => 'design'],
            ['id' => 4, 'name' => 'MacBook', 'parent_id' => 0, 'level' => 1, 'icon' => 'apple'],
            ['id' => 5, 'name' => 'Phụ Kiện', 'parent_id' => 0, 'level' => 1, 'icon' => 'accessories'],
        ];

        // Insert categories
        foreach ($categories as $category) {
            Category::updateOrCreate(['id' => $category['id']], $category);
        }

        $products = [
            [
                'name' => 'Laptop ASUS ROG Strix G15 G513IC',
                'short_description' => 'Laptop gaming mạnh mẽ với RTX 3050, AMD Ryzen 5',
                'description' => 'Laptop gaming ASUS ROG Strix G15 G513IC với bộ vi xử lý AMD Ryzen 5 4600H, card đồ họa NVIDIA RTX 3050, RAM 8GB, SSD 512GB. Màn hình 15.6" Full HD 144Hz, bàn phím RGB.',
                'price' => 18990000,
                'sale_price' => 16990000,
                'stock_quantity' => 15,
                'category_id' => 1,
                'category_name' => 'Laptop Gaming',
                'brand' => 'ASUS',
                'model' => 'ROG Strix G15 G513IC',
                'sku' => 'ASUS-G513IC-001',
                'is_featured' => true,
                'is_active' => true,
                'is_hot' => true,
                'rating_average' => 4.5,
                'rating_count' => 128,
                'featured_image' => 'asus-rog-strix-g15.jpg',
                'images' => ['asus-rog-strix-g15.jpg', 'asus-rog-strix-g15-2.jpg'],
                'specifications' => [
                    'CPU' => 'AMD Ryzen 5 4600H',
                    'RAM' => '8GB DDR4',
                    'Ổ cứng' => 'SSD 512GB NVMe',
                    'Card đồ họa' => 'NVIDIA GeForce RTX 3050 4GB',
                    'Màn hình' => '15.6" Full HD (1920x1080) 144Hz',
                    'Hệ điều hành' => 'Windows 11',
                    'Trọng lượng' => '2.3kg'
                ],
                'weight' => 2.3,
                'dimensions' => '35.4 x 25.9 x 2.27 cm'
            ],
            [
                'name' => 'MacBook Air M2 2022 13 inch',
                'short_description' => 'MacBook Air M2 với hiệu năng vượt trội và pin cực lâu',
                'description' => 'MacBook Air M2 2022 với chip M2 8-core CPU, 8-core GPU, 8GB RAM, 256GB SSD. Màn hình Liquid Retina 13.6 inch, thiết kế siêu mỏng nhẹ.',
                'price' => 28990000,
                'sale_price' => null,
                'stock_quantity' => 8,
                'category_id' => 4,
                'category_name' => 'MacBook',
                'brand' => 'Apple',
                'model' => 'MacBook Air M2',
                'sku' => 'APPLE-MBA-M2-001',
                'is_featured' => true,
                'is_active' => true,
                'is_new' => true,
                'rating_average' => 4.8,
                'rating_count' => 89,
                'featured_image' => 'macbook-air-m2.jpg',
                'images' => ['macbook-air-m2.jpg', 'macbook-air-m2-2.jpg'],
                'specifications' => [
                    'CPU' => 'Apple M2 8-core',
                    'RAM' => '8GB unified memory',
                    'Ổ cứng' => 'SSD 256GB',
                    'Card đồ họa' => 'Apple M2 8-core GPU',
                    'Màn hình' => '13.6" Liquid Retina (2560x1664)',
                    'Hệ điều hành' => 'macOS Monterey',
                    'Trọng lượng' => '1.24kg'
                ],
                'weight' => 1.24,
                'dimensions' => '30.41 x 21.5 x 1.13 cm'
            ],
            [
                'name' => 'Laptop Dell Inspiron 15 3520',
                'short_description' => 'Laptop văn phòng giá rẻ, phù hợp học tập công việc',
                'description' => 'Laptop Dell Inspiron 15 3520 với Intel Core i3-1115G4, RAM 4GB, SSD 256GB, màn hình 15.6" Full HD. Thiết kế thanh lịch phù hợp văn phòng.',
                'price' => 12990000,
                'sale_price' => 11490000,
                'stock_quantity' => 25,
                'category_id' => 2,
                'category_name' => 'Laptop Văn Phòng',
                'brand' => 'Dell',
                'model' => 'Inspiron 15 3520',
                'sku' => 'DELL-3520-001',
                'is_featured' => false,
                'is_active' => true,
                'rating_average' => 4.2,
                'rating_count' => 156,
                'featured_image' => 'dell-inspiron-15-3520.jpg',
                'images' => ['dell-inspiron-15-3520.jpg'],
                'specifications' => [
                    'CPU' => 'Intel Core i3-1115G4',
                    'RAM' => '4GB DDR4',
                    'Ổ cứng' => 'SSD 256GB',
                    'Card đồ họa' => 'Intel UHD Graphics',
                    'Màn hình' => '15.6" Full HD (1920x1080)',
                    'Hệ điều hành' => 'Windows 11',
                    'Trọng lượng' => '1.85kg'
                ],
                'weight' => 1.85,
                'dimensions' => '35.8 x 23.6 x 1.8 cm'
            ],
            [
                'name' => 'Laptop HP Pavilion Gaming 15-dk2055WM',
                'short_description' => 'Gaming laptop tầm trung với GTX 1650, Intel Core i5',
                'description' => 'HP Pavilion Gaming với Intel Core i5-11300H, NVIDIA GTX 1650 4GB, RAM 8GB, SSD 256GB + HDD 1TB, màn hình 15.6" Full HD 60Hz.',
                'price' => 16990000,
                'sale_price' => 15490000,
                'stock_quantity' => 12,
                'category_id' => 1,
                'category_name' => 'Laptop Gaming',
                'brand' => 'HP',
                'model' => 'Pavilion Gaming 15-dk2055WM',
                'sku' => 'HP-PG15-001',
                'is_featured' => true,
                'is_active' => true,
                'rating_average' => 4.3,
                'rating_count' => 97,
                'featured_image' => 'hp-pavilion-gaming-15.jpg',
                'images' => ['hp-pavilion-gaming-15.jpg', 'hp-pavilion-gaming-15-2.jpg'],
                'specifications' => [
                    'CPU' => 'Intel Core i5-11300H',
                    'RAM' => '8GB DDR4',
                    'Ổ cứng' => 'SSD 256GB + HDD 1TB',
                    'Card đồ họa' => 'NVIDIA GeForce GTX 1650 4GB',
                    'Màn hình' => '15.6" Full HD (1920x1080) 60Hz',
                    'Hệ điều hành' => 'Windows 11',
                    'Trọng lượng' => '2.23kg'
                ],
                'weight' => 2.23,
                'dimensions' => '36.0 x 26.0 x 2.35 cm'
            ],
            [
                'name' => 'Laptop Acer Predator Helios 300 PH315-54',
                'short_description' => 'Gaming laptop cao cấp RTX 3060, Intel Core i7 thế hệ 11',
                'description' => 'Acer Predator Helios 300 với Intel Core i7-11800H, RTX 3060 6GB, RAM 16GB, SSD 512GB, màn hình 15.6" Full HD 144Hz, hệ thống tản nhiệt AeroBlade 3D.',
                'price' => 32990000,
                'sale_price' => 29990000,
                'stock_quantity' => 6,
                'category_id' => 1,
                'category_name' => 'Laptop Gaming',
                'brand' => 'Acer',
                'model' => 'Predator Helios 300 PH315-54',
                'sku' => 'ACER-PH315-001',
                'is_featured' => true,
                'is_active' => true,
                'is_hot' => true,
                'rating_average' => 4.6,
                'rating_count' => 73,
                'featured_image' => 'acer-predator-helios-300.jpg',
                'images' => ['acer-predator-helios-300.jpg', 'acer-predator-helios-300-2.jpg'],
                'specifications' => [
                    'CPU' => 'Intel Core i7-11800H',
                    'RAM' => '16GB DDR4',
                    'Ổ cứng' => 'SSD 512GB NVMe',
                    'Card đồ họa' => 'NVIDIA GeForce RTX 3060 6GB',
                    'Màn hình' => '15.6" Full HD (1920x1080) 144Hz',
                    'Hệ điều hành' => 'Windows 11',
                    'Trọng lượng' => '2.3kg'
                ],
                'weight' => 2.3,
                'dimensions' => '36.3 x 25.5 x 2.3 cm'
            ]
        ];

        foreach ($products as $productData) {
            Product::create($productData);
        }

        $this->command->info('✅ Đã tạo dữ liệu mẫu cho bảng products tối ưu!');
    }
}