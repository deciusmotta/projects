<?php

use Faker\Generator as Faker;

$factory->define(App\Sprint::class, function (Faker $faker) {
    return [
        'title' => $faker->word,
        'started_at' => \Carbon\Carbon::now(),
        'ended_at' => \Carbon\Carbon::now()->addMonth(),
        'released_at'=> \Carbon\Carbon::now()->addMonth()->addDay(),
        'acceptance' => $faker->paragraph,
        'project_id' => factory(\App\Project::class)->create()->id
    ];
});
