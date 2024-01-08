<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    use HasFactory;

    public function bookmarkable()
    {
        return $this->morphTo();
    }

    protected static function boot()
    {
        parent::boot();
        self::saving(function ($bookmark) {
            $userForeignKey = 'user_id';
            $bookmark->{$userForeignKey} = $bookmark->{$userForeignKey} ?: auth()->id();
        });
    }

    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * @return BelongsTo
     */
    public function bookmarker()
    {
        return $this->user();
    }

    /**
     * @return Builder
     */
    public function scopeWithType(Builder $builder, string $type)
    {
        return $builder->where('bookmarkable_type', app($type)->getMorphClass());
    }
}
