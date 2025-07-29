<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

class Category extends Model implements TranslatableContract
{
    use Translatable;
    
    public $translatedAttributes = [
        'name',
        'description'
    ];
    
    protected $fillable = [
        'slug',
        'is_active',
        'parent_id'
    ];
    
    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($category) {
            // Use the translated name from the current locale for the slug
            if (!$category->slug && isset($category->translations[app()->getLocale()])) {
                $category->slug = Str::slug($category->translations[app()->getLocale()]->name);
            } elseif (!$category->slug && !empty($category->getTranslations('name'))) {
                // If current locale translation is not available, use the first available translation
                $name = array_values($category->getTranslations('name'))[0];
                $category->slug = Str::slug($name);
            }
        });
        
        // Slug is no longer automatically updated when name changes, as name is now translatable
        // If you want to update slug, it should be done explicitly
    }

    /**
     * Get the fruits that belong to this category.
     */
    public function fruits()
    {
        return $this->hasMany(Fruit::class);
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Get the parent category.
     */
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    /**
     * Get the child categories.
     */
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

        /**
     * Get all descendants of the category.
     */
    public function descendants()
    {
        return $this->children()->with('descendants');
    }

    /**
     * Get all ancestors of the category.
     */
    public function ancestors()
    {
        return $this->parent()->with('ancestors');
    }
}
