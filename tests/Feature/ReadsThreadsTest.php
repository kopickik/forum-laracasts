<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ReadsThreadsTest extends TestCase
{
    use DatabaseMigrations;
    protected $thread;

    public function setUp()
    {
        parent::setUp();
        $this->thread = create('App\Thread');
    }

    /** @test */
    function a_user_can_browse_threads() {
        $this->get('threads')
          ->assertStatus(200)
          ->assertSee($this->thread->title);
      }

    /** @test */
    function a_user_can_browse_a_single_thread() {
        $this->get("/threads/" . $this->thread->channel->slug . '/' . $this->thread->id)
          ->assertSee($this->thread->title);
      }

    /** @test */
    function a_user_can_view_replies_to_a_thread() {
        $reply = create('App\Reply',['thread_id' => $this->thread->id]);
        $this->get($this->thread->path())
          ->assertSee($reply->body);
      }

    /** @test */
    function a_user_can_filter_threads_according_to_a_channel()
    {
        $channel = create('App\Channel');
        $threadInChannel = create('App\Thread', ['channel_id' => $channel->id]);
        $threadNotInChannel = create('App\Thread');

        $this->get('threads/' . $channel->slug)
            ->assertSee($threadInChannel->title)
            ->assertDontSee($threadNotInChannel->title);
    }
}
