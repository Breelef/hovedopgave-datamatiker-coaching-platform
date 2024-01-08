<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Category extends Model
{
    use HasFactory;
    use HasSlug;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * Get the Category Group associated with the Category.
     */
    public function categoryGroup()
    {
        return $this->belongsTo(CategoryGroup::class, 'category_group_id');
    }

    /**
     * Get parent Category.
     */
    public function category()
    {
        return $this->belongsTo(self::class, 'category_id');
    }

    /**
     * Get child Categories.
     */
    public function categories()
    {
        return $this->hasMany(self::class, 'category_id');
    }

    public function exercises(): BelongsToMany
    {
        return $this->belongsToMany(Exercise::class, 'category_exercise');
    }

    public function guides(): BelongsToMany
    {
        return $this->belongsToMany(Guide::class, 'category_guide');
    }

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate();
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function getAllExercisesAttribute()
    {
        $exercises = $this->exercises;

        foreach ($this->categories as $category) {
            $exercises = $exercises->concat($category->allExercises);
        }

        return $exercises;
    }
}
