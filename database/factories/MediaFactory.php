<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\MediaLinks;
use Faker\Generator as Faker;

$factory->define(MediaLinks::class, function (Faker $faker) {
    return [
        'title' => $faker->text,
        'description' => $faker->paragraph,
        'link' => $faker->url,
        'source_id' => 1,
        'status' => 1
    ];
});
