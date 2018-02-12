<?php

use Faker\Generator as Faker;

$factory->define(App\Provider::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'api' => $faker->url
    ];
});
