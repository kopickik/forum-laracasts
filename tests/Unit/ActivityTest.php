<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ActivityTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function it_records_activity_when_a_thread_is_created()
    {
        $this->signIn();

        $thread = create('App\Thread');

        $this->assertDatabaseHas('activities', [
            'type' => 'created',
            'user_id' => auth()->id(),
            'subject_id' => $thread->id,
            'subject_type' => 'App\Thread'
        ]);
    }

}
