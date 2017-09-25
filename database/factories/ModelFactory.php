<?php

use Faker\Generator as Faker;

$factory->define(Forum\Thread::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'body' => $faker->paragraph,
        'user_id' => function () {
          return factory('Forum\User')->create()->id;
        }
    ];
});

$factory->define(Forum\Reply::class, function (Faker $faker) {
    return [
        'body' => $faker->paragraph,
        'user_id' => function () {
            return factory('Forum\User')->create()->id;
        },
        'thread_id' => function () {
            return factory('Forum\Thread')->create()->id;
        }
    ];
});
