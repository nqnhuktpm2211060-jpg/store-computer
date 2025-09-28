<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1) Populate categories.name from translations
        // Prefer Vietnamese (vi) if available, else any translation's name, else keep existing
        $translations = DB::table('category_translations')->select('category_id','language_code','name')->get();
        if ($translations->count() > 0) {
            // Group by category_id
            $grouped = $translations->groupBy('category_id');
            foreach ($grouped as $categoryId => $rows) {
                $vi = $rows->firstWhere('language_code', 'vi');
                $en = $rows->firstWhere('language_code', 'en');
                $any = $rows->first();
                $name = $vi->name ?? ($en->name ?? ($any->name ?? null));
                if ($name) {
                    DB::table('categories')->where('id', $categoryId)->update(['name' => $name]);
                }
            }
        }

        // 2) Ensure not-null names and sensible defaults
        DB::table('categories')->whereNull('name')->update(['name' => DB::raw("CONCAT('Category #', id)")]);

        // 3) Optionally normalize a few common computer-store names
        // Map some known aliases to consistent names (idempotent)
        $map = [
            'phu kien' => 'Phụ kiện',
            'phụ kiện' => 'Phụ kiện',
            'accessories' => 'Phụ kiện',
            'apple' => 'Apple',
            'iphone' => 'Apple',
            'ipad' => 'Apple',
            'airpods' => 'Apple',
            'laptop' => 'Laptop',
            'macbook' => 'Laptop',
            'pc' => 'PC - Máy tính để bàn',
            'desktop' => 'PC - Máy tính để bàn',
            'màn hình' => 'Màn hình',
            'monitor' => 'Màn hình',
            'vga' => 'Card đồ hoạ (GPU)',
            'gpu' => 'Card đồ hoạ (GPU)',
        ];
        $categories = DB::table('categories')->select('id','name')->get();
        foreach ($categories as $cat) {
            $n = mb_strtolower($cat->name ?? '');
            foreach ($map as $k => $v) {
                if ($n !== '' && mb_strpos($n, $k) !== false) {
                    DB::table('categories')->where('id', $cat->id)->update(['name' => $v]);
                    break;
                }
            }
        }

        // 4) Drop foreign keys or constraints if any (none defined explicitly here), then drop translations table
        if (Schema::hasTable('category_translations')) {
            Schema::drop('category_translations');
        }
    }

    public function down(): void
    {
        // Recreate category_translations table structure only (data won't be restored)
        Schema::create('category_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id');
            $table->string('language_code', 2);
            $table->string('name');
            $table->unique(['category_id', 'language_code']);
            $table->timestamps();
        });
    }
};
