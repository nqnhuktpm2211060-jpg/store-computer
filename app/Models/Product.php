<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name', 'slug', 'short_description', 'description',
        'price', 'sale_price', 'discount_percent',
        'stock_quantity', 'sold_quantity',
        'category_id', 'category_name',
        'images', 'featured_image',
        'specifications',
        'meta_title', 'meta_description', 'meta_keywords',
        'is_featured', 'is_active', 'is_hot', 'is_new',
        'view_count', 'rating_average', 'rating_count',
        'translations',
        'brand', 'model', 'sku',
        'weight', 'dimensions'
    ];

    protected $casts = [
        'images' => 'array',
        'specifications' => 'array',
        'translations' => 'array',
        'price' => 'decimal:2',
        'sale_price' => 'decimal:2',
        'weight' => 'decimal:2',
        'rating_average' => 'decimal:1',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'is_hot' => 'boolean',
        'is_new' => 'boolean',
    ];

    // Relationships
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class)->where('status', 1);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Accessors
    public function getCurrentPriceAttribute()
    {
        return $this->sale_price > 0 ? $this->sale_price : $this->price;
    }

    public function getHasSaleAttribute()
    {
        return $this->sale_price > 0 && $this->sale_price < $this->price;
    }

    public function getDiscountAmountAttribute()
    {
        if ($this->has_sale) {
            return $this->price - $this->sale_price;
        }
        return 0;
    }

    public function getIsInStockAttribute()
    {
        return $this->stock_quantity > 0;
    }

    public function getFormattedPriceAttribute()
    {
        return number_format($this->current_price, 0, '.', ',') . 'đ';
    }

    public function getFormattedOriginalPriceAttribute()
    {
        return number_format($this->price, 0, '.', ',') . 'đ';
    }

    // Helper methods for JSON fields
    protected function normalizeImageUrl($value)
    {
        if (!$value) return asset('assets/images/no-image.jpg');
        // If already absolute URL
        if (filter_var($value, FILTER_VALIDATE_URL)) {
            return $value;
        }
        // Normalize slashes
        $value = ltrim($value, '/');
        // If already starts with uploads/
        if (Str::startsWith($value, 'uploads/')) {
            return asset($value);
        }
        // Otherwise treat as filename under uploads/products
        return asset('uploads/products/' . $value);
    }

    protected function localImageExists($value): bool
    {
        if (!$value) return false;
        if (filter_var($value, FILTER_VALIDATE_URL)) return true; // assume reachable
        $v = ltrim($value, '/');
        if (Str::startsWith($v, 'uploads/')) {
            return file_exists(public_path($v));
        }
        return file_exists(public_path('uploads/products/' . $v));
    }

    public function getMainImageAttribute()
    {
        if ($this->featured_image && $this->localImageExists($this->featured_image)) {
            return $this->normalizeImageUrl($this->featured_image);
        }

        $images = $this->images;
        if (is_array($images) && !empty($images)) {
            foreach ($images as $img) {
                if ($this->localImageExists($img)) {
                    return $this->normalizeImageUrl($img);
                }
            }
        }

        return asset('assets/images/no-image.jpg');
    }

    public function getAllImagesAttribute()
    {
        $allImages = [];

        if ($this->featured_image && $this->localImageExists($this->featured_image)) {
            $allImages[] = $this->normalizeImageUrl($this->featured_image);
        }

        if (is_array($this->images)) {
            foreach ($this->images as $image) {
                if ($this->localImageExists($image)) {
                    $allImages[] = $this->normalizeImageUrl($image);
                }
            }
        }

        return array_values(array_unique($allImages));
    }

    public function getSpecificationValueAttribute($key)
    {
        $specs = $this->specifications;
        return is_array($specs) && isset($specs[$key]) ? $specs[$key] : null;
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeInStock($query)
    {
        return $query->where('stock_quantity', '>', 0);
    }

    public function scopeByCategory($query, $categoryId)
    {
        return $query->where('category_id', $categoryId);
    }

    public function scopeSearch($query, $keyword)
    {
        return $query->where(function($q) use ($keyword) {
            $q->where('name', 'LIKE', "%{$keyword}%")
              ->orWhere('short_description', 'LIKE', "%{$keyword}%")
              ->orWhere('description', 'LIKE', "%{$keyword}%")
              ->orWhere('brand', 'LIKE', "%{$keyword}%")
              ->orWhere('model', 'LIKE', "%{$keyword}%");
        });
    }

    // Auto-generate slug
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($product) {
            $product->slug = Str::slug($product->name);
        });
        
        static::updating(function ($product) {
            if ($product->isDirty('name')) {
                $product->slug = Str::slug($product->name);
            }
        });
    }

    // Translated helpers (from translations JSON)
    public function getNameTranslatedAttribute()
    {
        $locale = app()->getLocale();
        $trans = is_array($this->translations) ? ($this->translations[$locale] ?? null) : null;
        return $trans['name'] ?? $this->name;
    }

    public function getShortDescriptionTranslatedAttribute()
    {
        $locale = app()->getLocale();
        $trans = is_array($this->translations) ? ($this->translations[$locale] ?? null) : null;
        return $trans['short_description'] ?? $this->short_description;
    }

    public function getDescriptionTranslatedAttribute()
    {
        $locale = app()->getLocale();
        $trans = is_array($this->translations) ? ($this->translations[$locale] ?? null) : null;
        return $trans['description'] ?? $this->description;
    }

    // Characteristics derived from specifications JSON
    public function getCharacteristicsTranslatedAttribute()
    {
        // Return as array of objects with name and description keys to keep blade compatibility
        $specs = is_array($this->specifications) ? $this->specifications : [];
        $list = [];
        foreach ($specs as $name => $description) {
            $list[] = (object) ['name' => $name, 'description' => $description];
        }
        return $list;
    }
}
