<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'parent_id', 'level', 'icon'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function categoryParent(){
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function categoryChilden(){
        return $this->hasMany(Category::class, 'parent_id');
    }

    // translations removed; single-table approach

    public function getNameTranslatedAttribute(){
        // Keep category name stable across locales; ignore translation to avoid logic conflicts
        $name = trim((string)($this->attributes['name'] ?? ''));
        if ($name !== '') {
            return $name;
        }
        // Fallback to a readable placeholder if name is missing
        return 'Danh mục #' . (string) $this->attributes['id'];
    }

    // Helpers for icon normalization
    protected function normalizeIconUrl($value)
    {
        if (!$value) return asset('assets/icons/category-default.svg');
        if (filter_var($value, FILTER_VALIDATE_URL)) {
            return $value;
        }
        $v = ltrim($value, '/');
        if (Str::startsWith($v, 'uploads/')) {
            return asset($v);
        }
        if (Str::startsWith($v, 'assets/')) {
            return asset($v);
        }
        // assume filename under uploads/categories
        return asset('uploads/categories/' . $v);
    }

    protected function localIconExists($value): bool
    {
        if (!$value) return false;
        if (filter_var($value, FILTER_VALIDATE_URL)) return true; // assume reachable
        $v = ltrim($value, '/');
        if (Str::startsWith($v, 'uploads/')) {
            return file_exists(public_path($v));
        }
        if (Str::startsWith($v, 'assets/')) {
            return file_exists(public_path($v));
        }
        return file_exists(public_path('uploads/categories/' . $v));
    }

    public function getIconUrlAttribute()
    {
        // Keyword mapping for consistent visual style
        $name = mb_strtolower((string)($this->attributes['name'] ?? ''));
        $map = [
            // Accessories (force override to black glyph)
            'phụ kiện' => 'accessories.svg',
            'phu kien' => 'accessories.svg',
            'accessories' => 'accessories.svg',
            // Apple (force override)
            'apple' => 'apple.svg',
            'iphone' => 'apple.svg',
            'ipad' => 'apple.svg',
            'airpods' => 'apple.svg',
            // Input devices
            'chuột' => 'keyboard-mouse.svg',
            'ban phim' => 'keyboard-mouse.svg',
            'bàn phím' => 'keyboard-mouse.svg',
            'keyboard' => 'keyboard-mouse.svg',
            'mouse' => 'keyboard-mouse.svg',
            // Laptops
            'laptop' => 'laptop.svg',
            'macbook' => 'laptop.svg',
            // Desktops / PC
            'pc' => 'desktop.svg',
            'desktop' => 'desktop.svg',
            'máy tính để bàn' => 'desktop.svg',
            // Monitor
            'màn hình' => 'monitor.svg',
            'monitor' => 'monitor.svg',
            // GPU / VGA
            'vga' => 'gpu.svg',
            'gpu' => 'gpu.svg',
            'card màn hình' => 'gpu.svg',
        ];

        // Keywords that should always use mapped icons regardless of saved icon
        $forceOverrideKeywords = ['phụ kiện','phu kien','accessories','apple','iphone','ipad','airpods'];

        foreach ($map as $keyword => $file) {
            if ($keyword !== '' && $name !== '' && mb_strpos($name, $keyword) !== false) {
                if (in_array($keyword, $forceOverrideKeywords, true)) {
                    return asset('assets/icons/' . $file);
                }
                // Non-force keywords: use saved icon if valid, else mapped
                if ($this->icon && $this->localIconExists($this->icon)) {
                    return $this->normalizeIconUrl($this->icon);
                }
                return asset('assets/icons/' . $file);
            }
        }

        // No keyword match: use saved icon if valid, else default
        if ($this->icon && $this->localIconExists($this->icon)) {
            return $this->normalizeIconUrl($this->icon);
        }
        return asset('assets/icons/category-default.svg');
    }
}
