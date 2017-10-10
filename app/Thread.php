<?php

namespace App;

use App\Filters\ThreadsFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    /**
     * Don't auto-apply mass assignment protection.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Get a string path for the thread.
     *
     * @return string
     */
    public function path()
    {
        return "/threads/{$this->channel->slug}/{$this->id}";
    }

    /**
     * A thread may have many replies.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    /**
     * A thread belongs to a creator.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Add a reply to the thread.
     *
     * @param $reply
     */
    public function addReply($reply)
    {
        $this->replies()->create($reply);
    }

    /**
     * Apply all relevant thread filters.
     * 
     * @param Builder $query
     * @param ThreadsFilter $filters
     * @return Builder
     */
    public function scopeFilter($query, ThreadsFilter $filters)
    {
        return $filters->apply($query);
    }

    /**
    * A thread is assigned a channel.
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }

}