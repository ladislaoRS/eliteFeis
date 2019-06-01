<?php

use Faker\Generator as Faker;

$factory->define(App\Tag::class, function (Faker $faker) {
    $word = $faker->unique()->word;
    return [
        'slug' => $word,
        'name' => $word,
    ];
});
