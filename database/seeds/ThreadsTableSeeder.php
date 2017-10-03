<?php

use Illuminate\Database\Seeder;

class ThreadsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $threads = factory('App\Thread', 6)->create();
        $threads->each(function($t) {
            factory('App\Reply', rand(0, 3))->create(['thread_id' => $t->id]);
        });
    }
}
