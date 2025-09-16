<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogTranslation extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'blog_id',
        'language_code',
        'title',
        'short_content',
        'content',
        'sub_categories',
        'slug',
    ];
}
