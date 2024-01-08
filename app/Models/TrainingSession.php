<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class TrainingSession extends Model
{
    use HasFactory;
    use HasSlug;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    public function sessionGroup()
    {
        return $this->belongsTo(SessionGroup::class);
    }

    public function exercises(): BelongsToMany
    {
        return $this->belongsToMany(Exercise::class, 'exercise_training_session')->withPivot('duration');
    }

    public function trainingSessionExercises(): HasMany
    {
        return $this->hasMany(ExerciseTrainingSession::class);

    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom([$this, 'getSlugSourceString'])
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate();
    }

    public function getSlugSourceString(): string
    {
        return "{$this->sessionGroup->trainingPlan->name} {$this->sessionGroup->name} {$this->name} - ".$this->sessionGroup->getDurationAsWeekStringAttribute();
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
