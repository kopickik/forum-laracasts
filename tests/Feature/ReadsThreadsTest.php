<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Carbon;

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

    /** @test */
    function a_user_can_filter_threads_by_any_username()
    {
        $this->signIn(create('App\User', ['name' => 'John Doe']));
        
        $johnDoesThread = create('App\Thread', ['user_id' => auth()->id()]);
        $notJohnsThread = create('App\Thread');

        $this->get('threads?by=John Doe')
            ->assertSee($johnDoesThread->title)
            ->assertDontSee($notJohnsThread->title);
    }

    /** @test */
    function a_user_can_filter_threads_by_popularity()
    {
        $threadWithTwoReplies = create('App\Thread', ['created_at' => new Carbon('-2 minute')]);
        create('App\Reply', ['thread_id' => $threadWithTwoReplies->id], 2);

        $threadWithThreeReplies = create('App\Thread', ['created_at' => new Carbon('-1 minute')]);
        create('App\Reply', ['thread_id' => $threadWithThreeReplies->id], 3);

        $threadWithNoReplies = $this->thread;

        $response = $this->getJson('threads?popular=1')->json();

        $this->assertEquals([3, 2, 0], array_column($response, 'replies_count'));
    }
}
