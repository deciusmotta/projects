<?php

use Faker\Generator as Faker;

$factory->define(App\Repo::class, function (Faker $faker) {
    return [
        'project_id' => factory(\App\Project::class)->create()->id,
        'provider_id' => factory(\App\Provider::class)->create()->id,
        'url' => $faker->url
    ];
});
