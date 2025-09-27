<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Log;

class ProductService
{
    /**
     * Lấy danh sách sản phẩm nổi bật với thông tin đầy đủ
     */
    public function getFeaturedProducts($limit = 5)
    {
        return Product::with('category')
            ->active()
            ->featured()
            ->inStock()
            ->select('id', 'name', 'slug', 'price', 'sale_price', 'stock_quantity', 
                    'category_id', 'category_name', 'short_description', 'featured_image', 
                    'brand', 'model', 'rating_average', 'rating_count')
            ->orderBy('rating_average', 'desc')
            ->limit($limit)
            ->get();
    }

    /**
     * Lấy danh sách sản phẩm theo danh mục
     */
    public function getProductsByCategory($categoryName, $limit = 5)
    {
        return Product::with('category')
            ->active()
            ->inStock()
            ->where(function($query) use ($categoryName) {
                $query->whereHas('category', function($q) use ($categoryName) {
                    $q->where('name', 'LIKE', "%{$categoryName}%");
                })->orWhere('category_name', 'LIKE', "%{$categoryName}%");
            })
            ->select('id', 'name', 'slug', 'price', 'sale_price', 'stock_quantity', 
                    'category_id', 'category_name', 'short_description', 'featured_image',
                    'brand', 'model')
            ->limit($limit)
            ->get();
    }

    /**
     * Tìm kiếm sản phẩm theo từ khóa (cải thiện)
     */
    public function searchProducts($keyword, $limit = 5)
    {
        return Product::with('category')
            ->active()
            ->inStock()
            ->search($keyword)
            ->select('id', 'name', 'slug', 'price', 'sale_price', 'stock_quantity', 
                    'category_id', 'category_name', 'short_description', 'featured_image',
                    'brand', 'model', 'rating_average')
            ->orderBy('rating_average', 'desc')
            ->limit($limit)
            ->get();
    }

    /**
     * Lấy sản phẩm theo thương hiệu
     */
    public function getProductsByBrand($brand, $limit = 5)
    {
        return Product::with('category')
            ->active()
            ->inStock()
            ->where('brand', 'LIKE', "%{$brand}%")
            ->select('id', 'name', 'slug', 'price', 'sale_price', 'stock_quantity', 
                    'category_id', 'category_name', 'short_description', 'featured_image',
                    'brand', 'model')
            ->limit($limit)
            ->get();
    }

    /**
     * Lấy danh sách danh mục
     */
    public function getCategories()
    {
        return Category::select('id', 'name', 'parent_id')
            ->limit(10)
            ->get();
    }

    /**
     * Lấy thông tin tổng quan nâng cao để cung cấp cho AI
     */
    public function getStoreContext()
    {
        $categories = $this->getCategories();
        $featuredProducts = $this->getFeaturedProducts(8);
        // Ensure safe distinct brand retrieval across DB drivers
        $brands = Product::active()
            ->whereNotNull('brand')
            ->select('brand')
            ->distinct()
            ->pluck('brand')
            ->filter()
            ->take(5);
        
        $context = "🏪 THÔNG TIN CỬA HÀNG MÁY TÍNH - LAPTOP:\n\n";
        
        // Danh mục sản phẩm
        $context .= "📂 DANH MỤC SẢN PHẨM:\n";
        try {
            foreach ($categories as $category) {
                $productCount = Product::active()->byCategory($category->id)->count();
                $context .= "• {$category->name} ({$productCount} sản phẩm)\n";
            }
        } catch (\Throwable $e) {
            Log::warning('Chat context category count failed', ['error' => $e->getMessage()]);
        }
        
        // Thương hiệu
        if ($brands->isNotEmpty()) {
            $context .= "\n🏷️ THƯƠNG HIỆU CÓ SẴN:\n";
            foreach ($brands as $brand) {
                $context .= "• {$brand}\n";
            }
        }
        
        $context .= "\n⭐ SẢN PHẨM NỔI BẬT & ĐƯỢC ĐÁNH GIÁ TỐT:\n";
        try {
            foreach ($featuredProducts as $product) {
                $price = $product->current_price;
                $originalPrice = $product->has_sale ? " (Giá gốc: " . number_format($product->price) . "đ)" : "";
                $rating = $product->rating_average > 0 ? " ⭐" . $product->rating_average . "/5 ({$product->rating_count} đánh giá)" : "";

                $context .= "• {$product->name}\n";
                $context .= "  └ Thương hiệu: " . ($product->brand ?? 'Không rõ') . "\n";
                $context .= "  └ Danh mục: " . ($product->category_name ?? ($product->category->name ?? '')) . "\n";
                $context .= "  └ Giá: " . number_format($price) . "đ{$originalPrice}\n";
                $context .= "  └ Còn hàng: {$product->stock_quantity} máy{$rating}\n";

                if ($product->short_description) {
                    $context .= "  └ Mô tả: {$product->short_description}\n";
                }
                $context .= "\n";
            }
        } catch (\Throwable $e) {
            Log::warning('Chat context products section failed', ['error' => $e->getMessage()]);
        }
        
        $context .= "💡 LƯU Ý CHO TƯ VẤN:\n";
        $context .= "• Luôn đề xuất sản phẩm CÓ SẴN trong kho\n";
        $context .= "• Ưu tiên sản phẩm có đánh giá tốt\n";
        $context .= "• Tư vấn theo nhu cầu: gaming, văn phòng, đồ họa\n";
        $context .= "• Có thể so sánh giá và tính năng\n\n";
        
        // Hard-cap context length to keep prompt small (~1200-1500 chars)
        if (mb_strlen($context) > 1500) {
            $context = mb_substr($context, 0, 1500) . "\n…";
        }
        return $context;
    }

    /**
     * Tìm sản phẩm theo mức giá
     */
    public function getProductsByPriceRange($minPrice, $maxPrice, $limit = 5)
    {
        return Product::with('category')
            ->active()
            ->inStock()
            ->where(function($query) use ($minPrice, $maxPrice) {
                $query->where(function($q) use ($minPrice, $maxPrice) {
                    // Kiểm tra sale_price nếu có
                    $q->where('sale_price', '>', 0)
                      ->whereBetween('sale_price', [$minPrice, $maxPrice]);
                })->orWhere(function($q) use ($minPrice, $maxPrice) {
                    // Kiểm tra price nếu không có sale_price
                    $q->where(function($subQ) {
                        $subQ->whereNull('sale_price')->orWhere('sale_price', '<=', 0);
                    })->whereBetween('price', [$minPrice, $maxPrice]);
                });
            })
            ->select('id', 'name', 'slug', 'price', 'sale_price', 'stock_quantity', 
                    'category_name', 'brand', 'model')
            ->limit($limit)
            ->get();
    }
}