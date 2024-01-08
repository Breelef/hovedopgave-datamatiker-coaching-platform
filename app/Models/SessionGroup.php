<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Tags\HasTags;

class SessionGroup extends Model
{
    use HasFactory;
    use HasSlug;
    use HasTags;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    public function getTagsAsStringAttribute()
    {
        return $this->tags->map(function ($tag) {
            return $tag->name.' ('.$tag->type.')';
        })->join(', ');
    }

    public function trainingPlan()
    {
        return $this->belongsTo(TrainingPlan::class);
    }

    public function trainingSessions()
    {
        return $this->hasMany(TrainingSession::class);
    }

    public function getDurationAsWeekStringAttribute()
    {
        $startWeek = Carbon::parse($this->starts_at)->weekOfYear;
        $endWeek = Carbon::parse($this->ends_at)->weekOfYear;

        return 'Uge '.$startWeek.'-'.$endWeek;
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
        return "{$this->trainingPlan->name} {$this->name} - ".$this->getDurationAsWeekStringAttribute();
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function scopeValidEndDate($query)
    {
        return $query->where(function ($query) {
            $query->where('ends_at', '>=', now())->orWhereNull('ends_at');
        });
    }
}
