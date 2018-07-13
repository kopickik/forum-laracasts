<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;

use App\Favorite;

trait Favoritable
{
    /**
     * Boot the trait.
     */
    protected static function bootFavoritable(){
        static::deleting(function ($model) {
            $model->favorites->each->delete();
        });
    }

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
     * Unfavorite the current entity.
     */
    public function unfavorite()
    {
        $attributes = ['user_id' => auth()->id()];

        $this->favorites()->where($attributes)->get()->each->delete();
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
     * Fetch the favorited status as a prop.
     */
    public function getIsFavoritedAttribute()
    {
        return $this->isFavorited();
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
