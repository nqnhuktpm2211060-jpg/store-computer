<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Blog extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'short_content',
        'content',
        'category_id',
        'sub_categories',
        'image',
        'user_id',
        'slug',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function translations(){
        return $this->hasMany(BlogTranslation::class);
    }

    public function getTitleTranslatedAttribute()
    {
        return $this->translations->where('language_code', App::getLocale())->first()->title ?? $this->title;
    }
    public function getShortContentTranslatedAttribute()
    {
        return $this->translations->where('language_code', App::getLocale())->first()->short_content ?? $this->short_content;
    }
    public function getContentTranslatedAttribute()
    {
        return $this->translations->where('language_code', App::getLocale())->first()->content ?? $this->content;   
    }
    public function getSubCategoriesTranslatedAttribute()
    {
        return $this->translations->where('language_code', App::getLocale())->first()->sub_categories ?? $this->sub_categories;
    }
    public function getSlugTranslatedAttribute()
    {
        return $this->translations->where('language_code', App::getLocale())->first()->slug ?? $this->slug;   
    }
}
