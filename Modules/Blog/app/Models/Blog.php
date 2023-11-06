<?php

namespace Modules\Blog\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Blog\Database\factories\BlogFactory;
use Modules\Category\app\Models\Category;
use Spatie\Translatable\HasTranslations;

class Blog extends Model
{
    use HasTranslations;
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $guarded = [];
    public $translatable = ['title', 'slug', 'desc'];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    protected static function newFactory(): BlogFactory
    {
        //return BlogFactory::new();
    }
}
