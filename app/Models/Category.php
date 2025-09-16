<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\App;

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

    public function translations(){
        return $this->hasMany(CategoryTranslation::class);
    }

    public function getNameTranslatedAttribute(){
        return $this->translations()->where('language_code', App::getLocale())->first()->name ?? $this->name;
    }
}
