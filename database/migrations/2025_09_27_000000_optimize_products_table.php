<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Drop bảng products cũ và tạo lại tối ưu
        Schema::dropIfExists('products');
        
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            
            // Thông tin cơ bản
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('short_description')->nullable();
            $table->longText('description')->nullable();
            
            // Giá cả
            $table->decimal('price', 12, 2);
            $table->decimal('sale_price', 12, 2)->nullable();
            $table->integer('discount_percent')->default(0);
            
            // Kho hàng
            $table->integer('stock_quantity')->default(0);
            $table->integer('sold_quantity')->default(0);
            
            // Danh mục
            $table->unsignedBigInteger('category_id');
            $table->string('category_name')->nullable(); // Cache tên danh mục
            
            // Hình ảnh (JSON array chứa nhiều ảnh)
            $table->json('images')->nullable();
            $table->string('featured_image')->nullable(); // Ảnh chính
            
            // Thông số kỹ thuật (JSON)
            $table->json('specifications')->nullable();
            
            // SEO & Marketing
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
            
            // Trạng thái
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            $table->boolean('is_hot')->default(false);
            $table->boolean('is_new')->default(false);
            
            // Thống kê
            $table->unsignedBigInteger('view_count')->default(0);
            $table->decimal('rating_average', 2, 1)->default(0);
            $table->integer('rating_count')->default(0);
            
            // Đa ngôn ngữ (JSON cho Vietnamese & English)
            $table->json('translations')->nullable();
            
            // Brand & Model
            $table->string('brand')->nullable();
            $table->string('model')->nullable();
            $table->string('sku')->unique()->nullable();
            
            // Shipping
            $table->decimal('weight', 8, 2)->nullable();
            $table->string('dimensions')->nullable(); // LxWxH
            
            $table->timestamps();
            
            // Indexes để tối ưu query
            $table->index('category_id');
            $table->index('is_featured');
            $table->index('is_active');
            $table->index(['price', 'sale_price']);
            $table->index('created_at');
            $table->index('view_count');
        });
        
        // Drop các bảng không cần thiết
        Schema::dropIfExists('images');
        Schema::dropIfExists('product_characteristics');
        Schema::dropIfExists('product_translations');
        Schema::dropIfExists('product_characteristic_translations');
        Schema::dropIfExists('product_views');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Khôi phục lại cấu trúc cũ nếu cần
        Schema::dropIfExists('products');
        
        // Tạo lại bảng products cũ
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->text('short_description')->nullable();
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2);
            $table->integer('stock_quantity');
            $table->unsignedBigInteger('category_id');
            $table->integer('total_purchases')->default(0);
            $table->boolean('is_on_featured')->default(false);
            $table->decimal('sale_price', 10, 2)->nullable();
            $table->unsignedBigInteger('view_count')->default(0);
            $table->timestamps();
        });
    }
};