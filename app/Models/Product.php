<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\App;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'short_description', 'description', 'price', 'stock_quantity', 'category_id', 'total_purchases', 'is_on_featured', 'sale_price', 'view_count'];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function characteristics()
    {
        return $this->hasMany(ProductCharacteristics::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class)->where('status', 1);
    }

    public function getHasSaleAttribute()
    {
        return (float) $this->sale_price > 0;
    }

    public function views()
    {
        return $this->hasMany(ProductView::class);
    }

    public function translations()
    {
        return $this->hasMany(ProductTranslation::class);
    }

    public function getNameTranslatedAttribute()
    {
        return $this->translations->where('language_code', App::getLocale())->first()->name ?? $this->name;
    }

    public function getDescriptionTranslatedAttribute()
    {
        return $this->translations->where('language_code', App::getLocale())->first()->description ?? $this->description;
    }

    public function getShortDescriptionTranslatedAttribute()
    {
        return $this->translations->where('language_code', App::getLocale())->first()->short_description ?? $this->short_description;
    }

    public function characteristicsTranslations()
    {
        return $this->hasMany(ProductCharacteristicTranslation::class);
    }

    public function getCharacteristicsTranslatedAttribute()
    {
        $translated = $this->characteristicsTranslations->where('language_code', App::getLocale());

        return $translated->isNotEmpty()
            ? $translated
            : $this->characteristics;
    }
}
