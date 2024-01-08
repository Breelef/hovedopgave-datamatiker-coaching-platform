<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;

trait Bookmarker
{
    /**
     * @return null
     */
    public function bookmark(Model $model)
    {
        if (! $this->hasBookmarked($model)) {
            $bookmark = new \App\Models\Bookmark;
            $bookmark->{'user_id'} = $this->getKey();

            $model->bookmarks()->save($bookmark);
        }

        return null;
    }

    public function unBookmark(Model $model)
    {
        $relation = $model->bookmarks()->where('bookmarkable_id', $model->getKey())->where('bookmarkable_type', $model->getMorphClass())->where('user_id', $this->getKey())->first();
        if ($relation) {
            $relation->delete();
        }
    }

    /**
     * @return void|null
     */
    public function toggleBookmark(Model $model)
    {
        return $this->hasBookmarked($model) ? $this->unBookmark($model) : $this->bookmark($model);
    }

    /**
     * @return bool
     */
    public function hasBookmarked(Model $model)
    {
        return ($this->relationLoaded('bookmarks') ? $this->bookmarks : $this->bookmarks())->where('bookmarkable_id', $model->getKey())->where('bookmarkable_type', $model->getMorphClass())->count() > 0;
    }

    /**
     * @return mixed
     */
    public function bookmarks()
    {
        return $this->hasMany(\App\Models\Bookmark::class, 'user_id', $this->getKeyName());
    }
}
