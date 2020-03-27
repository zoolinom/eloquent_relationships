<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Postm;
use Faker\Generator as Faker;

$factory->define(Postm::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'body' => $faker->paragraph
    ];
});
