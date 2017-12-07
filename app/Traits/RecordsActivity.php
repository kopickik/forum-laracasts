<?php

namespace App\Traits;

use App\Activity;

trait RecordsActivity
{
    /**
     * Boot the trait. This is the preferred naming scheme, "boot"+traitName
     */
    protected static function bootRecordsActivity()
    {
        if (auth()->guest()) return;

        foreach (static::getActivitiesToRecord() as $event) {
            static::$event(function ($model) use ($event) {
                $model->recordActivity($event);
            });
        }

        static::deleting(function ($model) {
            $model->activity()->delete();
        });
    }

    /**
     * Get all model events related that require activity recording.
     * 
     * @return array
     */
    protected static function getActivitiesToRecord()
    {
        return ['created'];
    }

    /**
     * Record new activity for the model.
     * 
     * @param string $eventType
     */
    protected function recordActivity($eventType)
    {
        $this->activity()->create([
            'user_id' => auth()->id(),
            'type' => $this->getActivityType($eventType)
        ]);
    }

    /**
     * Fetch the activity relationship.
     * 
     * @return \Illuminate\Eloquent\Database\Relations\MorphMany
     */
    public function activity()
    {
        return $this->morphMany('App\Activity', 'subject');
    }

    /**
     * Determine the activity type.
     * 
     * @param string $event
     * @return string
     */
    protected function getActivityType($event)
    {
        $type = strtolower((new \ReflectionClass($this))->getShortName());

        return "{$event}_{$type}";
    }

}
