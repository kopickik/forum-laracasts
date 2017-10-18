<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ProfilesTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_user_has_a_profile()
    {
        $user = create('App\User');

        $this->get(route('profile', $user->name))
             ->assertSee($user->name);
    }

    /** @test */
    public function profiles_display_threads_associated_with_a_user()
    {
        $user = create('App\User');
        $thread = create('App\Thread', ['user_id' => $user->id]);

        $this->get(route('profile', $user->name))
             ->assertSee($thread->title)
             ->assertSee($thread->body);
    }
}
