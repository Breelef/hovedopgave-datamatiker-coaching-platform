<?php

namespace App\Models;

use App\Traits\Bookmarkable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Tags\HasTags;

class Exercise extends Model
{
    use Bookmarkable;
    use HasFactory;
    use HasSlug;
    use HasTags;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

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

    public function getTagsAsStringAttribute()
    {
        return $this->tags->map(function ($tag) {
            return $tag->name.' ('.$tag->type.')';
        })->join(', ');
    }

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    //    public function getDurationAsStringAttribute(){
    //        return $this->duration_from . '-' . $this->duration_to;
    //    }

    public function setDescriptionAttribute($value)
    {
        $this->attributes['description'] = json_encode($value);
    }

    public function getDescriptionAttribute($value)
    {
        return json_decode($value, true);
    }
    public function children(): BelongsToMany
    {
        return $this->belongsToMany(Exercise::class, 'exercise_exercise', 'parent_exercise_id', 'child_exercise_id');
    }

    public function exercises(): BelongsToMany
    {
        return $this->belongsToMany(Exercise::class, 'exercise_exercise', 'child_exercise_id', 'parent_exercise_id');
    }

    public function equipment(): BelongsToMany
    {
        return $this->belongsToMany(Equipment::class, 'equipment_exercise')->withPivot('quantity');
    }

    public function trainingSessions(): BelongsToMany
    {
        return $this->belongsToMany(TrainingSession::class, 'exercise_training_session')->withPivot('duration');
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'category_exercise');
    }

    public function ageGroupFrom(): BelongsTo
    {
        return $this->belongsTo(AgeGroup::class, 'age_group_id_from');
    }

    public function ageGroupTo(): BelongsTo
    {
        return $this->belongsTo(AgeGroup::class, 'age_group_id_to');
    }
}
