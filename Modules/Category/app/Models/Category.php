<?php

namespace Modules\Category\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Blog\app\Models\Blog;
use Modules\Category\Database\factories\CategoryFactory;
use Spatie\Translatable\HasTranslations;

class Category extends Model
{
    use HasTranslations;
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $guarded = [];
    public $translatable = ['name', 'slug'];

    public function blogs() {
        return $this->hasMany(Blog::class);
    }
    protected static function newFactory(): CategoryFactory
    {
        //return CategoryFactory::new();
    }
}
