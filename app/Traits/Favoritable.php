<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;

use App\Favorite;

trait Favoritable
{
    /**
     * An entity can be favorited.
     * 
     * @return Illuminate\Database\Eloquent\Relationships\MorphMany
     */
    public function favorites()
    {
        return $this->morphMany(Favorite::class, 'favorited');
    }

    /**
     * Favorite the current entity.
     *
     * @return Model
     */
    public function favorite()
    {
        $attributes = ['user_id' => auth()->id()];

        if (! $this->favorites()->where($attributes)->exists()) {
            return $this->favorites()->create($attributes);
        }
    }

    /**
     * Determine if the entity is favorited.
     *
     * @return boolean
     */
    public function isFavorited()
    {
        return !! $this->favorites->where('user_id', auth()->id())->count();
    }

    /**
     * Get the number of favorites for the entity as an attribute.
     *
     * @return integer
     */
    public function getFavoritesCountAttribute()
    {
        return $this->favorites->count();
    }
}
