<?php

namespace App\Traits;

use App\Activity;

trait RecordsActivity
{
    protected static function bootRecordsActivity()
    {
        static::created(function ($thread) {
            $thread->recordActivity('created');
        });
    }

    protected function recordActivity($eventType)
    {
        Activity::create([
            'type' => $eventType,
            'user_id' => auth()->id(),
            'subject_id' => $this->id,
            'subject_type' => get_class($this)
        ]);
    }

}
