<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;

trait Bookmarkable
{
    /**
     * @return bool
     */
    public function isBookmarkedBy(Model $user)
    {
        if (is_a($user, \App\Models\User::class)) {
            if ($this->relationLoaded('bookmarkers')) {
                return $this->bookmarkers->contains($user);
            }

            return ($this->relationLoaded('bookmarks') ? $this->bookmarks : $this->bookmarks())->where('user_id', $user->getKey())->count() > 0;
        }

        return false;
    }

    /**
     * @return mixed
     */
    public function bookmarks()
    {
        return $this->morphMany(\App\Models\Bookmark::class, 'bookmarkable');
    }

    /**
     * @return mixed
     */
    public function bookmarkers()
    {
        return $this->belongsToMany(config('auth.providers.users.model'), 'bookmarks', 'bookmarkable_id', 'user_id')->where('bookmarkable_type', $this->getMorphClass());
    }
}
