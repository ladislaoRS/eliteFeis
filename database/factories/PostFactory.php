<?php

use Faker\Generator as Faker;

$factory->define(App\Post::class, function (Faker $faker) {
    
    $title = $faker->sentence;
    
    return [
        'user_id' => App\User::all()->random()->id,
        'tag_id' => App\Tag::all()->random()->id,
        'title' => $title,
        'subtitle' => $faker->sentence(15),
        'body' => $faker->paragraph(rand(10, 30), true),
        'visits' => 0
    ];
});
