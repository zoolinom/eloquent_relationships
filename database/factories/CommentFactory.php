<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Comment;
use App\Postm;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'postm_id' => function() {
            return factory(Postm::class)->create()->id;
        },
        'body' => $faker->paragraph
    ];
});
