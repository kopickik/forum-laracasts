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
        $threads = factory('App\Thread', 12)->create();
        $threads->each(function($t) {
            factory('App\Reply', 5)->create(['thread_id' => $t->id]);
        });
    }
}
