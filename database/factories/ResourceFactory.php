<?php

use Faker\Generator as Faker;

$factory->define(App\Resource::class, function (Faker $faker) {
    $word = $faker->word;
    return [
         'name' =>$word,
        'description' => $faker->paragraph,
        'value' => $word
    ];
});
