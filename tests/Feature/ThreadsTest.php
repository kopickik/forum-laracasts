<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ThreadsTest extends TestCase {
  use DatabaseMigrations;
  protected $thread;

  public function setUp() {
    parent::setUp();
    $this->thread = create('App\Thread');
  }

  public function test_a_user_can_browse_threads() {
    $this->get('/threads')
      ->assertStatus(200)
      ->assertSee($this->thread->title);
  }
  
  public function test_a_user_can_browse_a_single_thread() {
    $this->get('/threads/' . $this->thread->id)
      ->assertSee($this->thread->title);
  }

  public function test_a_user_can_view_replies_to_a_thread() {
    $reply = create('App\Reply',['thread_id' => $this->thread->id]);
    $this->get('/threads/' . $this->thread->id)
      ->assertSee($reply->body);
  }

  public function test_a_thread_has_replies() {
    $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->thread->replies);
  }

  public function test_a_thread_has_a_creator() {
    $this->assertInstanceOf('App\User', $this->thread->creator);
  }

  /** @test */
  public function a_thread_can_add_a_reply()
  {
    $this->thread->addReply([
      'body' => 'Foobar',
      'user_id' => 1
    ]);
    $this->assertCount(1, $this->thread->replies);
  }

  /** @test */
  function a_thread_belongs_to_a_channel()
  {
    $this->assertInstanceOf('App\Channel', $this->thread->channel);
  }

}
