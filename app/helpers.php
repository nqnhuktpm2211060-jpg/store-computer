<?php

if (!function_exists('getProductMainImage')) {
    /**
     * Helper function để lấy ảnh chính của sản phẩm
     */
    function getProductMainImage($product) {
        if (!$product) return asset('assets/images/no-image.jpg');
        
        if ($product->featured_image) {
            return asset('uploads/products/' . $product->featured_image);
        }
        
        $images = $product->images;
        if (is_array($images) && !empty($images)) {
            return asset('uploads/products/' . $images[0]);
        }
        
        return asset('assets/images/no-image.jpg');
    }
}

if (!function_exists('getProductImages')) {
    /**
     * Helper function để lấy tất cả ảnh của sản phẩm
     */
    function getProductImages($product) {
        if (!$product) return [];
        
        $allImages = [];
        
        if ($product->featured_image) {
            $allImages[] = asset('uploads/products/' . $product->featured_image);
        }
        
        if (is_array($product->images)) {
            foreach ($product->images as $image) {
                $allImages[] = asset('uploads/products/' . $image);
            }
        }
        
        return array_unique($allImages);
    }
}

if (!function_exists('getProductCurrentPrice')) {
    /**
     * Helper function để lấy giá hiện tại (có sale thì lấy sale_price)
     */
    function getProductCurrentPrice($product) {
        if (!$product) return 0;
        
        return $product->sale_price > 0 ? $product->sale_price : $product->price;
    }
}

if (!function_exists('formatPrice')) {
    /**
     * Helper function để format giá tiền
     */
    function formatPrice($price) {
        return number_format($price, 0, '.', ',') . 'đ';
    }
}