<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Category;

class ProductService
{
    /**
     * Lấy danh sách sản phẩm nổi bật với thông tin cơ bản
     */
    public function getFeaturedProducts($limit = 5)
    {
        return Product::with('category')
            ->where('is_on_featured', 1)
            ->where('stock_quantity', '>', 0)
            ->select('id', 'name', 'price', 'sale_price', 'stock_quantity', 'category_id', 'short_description')
            ->limit($limit)
            ->get();
    }

    /**
     * Lấy danh sách sản phẩm theo danh mục
     */
    public function getProductsByCategory($categoryName, $limit = 5)
    {
        return Product::with('category')
            ->whereHas('category', function($query) use ($categoryName) {
                $query->where('name', 'LIKE', "%{$categoryName}%");
            })
            ->where('stock_quantity', '>', 0)
            ->select('id', 'name', 'price', 'sale_price', 'stock_quantity', 'category_id', 'short_description')
            ->limit($limit)
            ->get();
    }

    /**
     * Tìm kiếm sản phẩm theo tên
     */
    public function searchProducts($keyword, $limit = 5)
    {
        return Product::with('category')
            ->where('name', 'LIKE', "%{$keyword}%")
            ->where('stock_quantity', '>', 0)
            ->select('id', 'name', 'price', 'sale_price', 'stock_quantity', 'category_id', 'short_description')
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
     * Lấy thông tin tổng quan để cung cấp cho AI
     */
    public function getStoreContext()
    {
        $categories = $this->getCategories();
        $featuredProducts = $this->getFeaturedProducts(8);
        
        $context = "THÔNG TIN CỬA HÀNG MÁY TÍNH:\n\n";
        
        // Danh mục sản phẩm
        $context .= "DANH MỤC SẢN PHẨM:\n";
        foreach ($categories as $category) {
            $context .= "- {$category->name}\n";
        }
        
        $context .= "\nSẢN PHẨM NỔI BẬT:\n";
        foreach ($featuredProducts as $product) {
            $price = $product->sale_price > 0 ? number_format($product->sale_price) : number_format($product->price);
            $context .= "- {$product->name} (Danh mục: {$product->category->name}) - Giá: {$price}đ - Còn hàng: {$product->stock_quantity}\n";
            if ($product->short_description) {
                $context .= "  Mô tả: {$product->short_description}\n";
            }
        }
        
        return $context;
    }
}