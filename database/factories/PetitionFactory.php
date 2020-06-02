<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\PetitionLinks;
use Faker\Generator as Faker;

$factory->define(PetitionLinks::class, function (Faker $faker) {
    return [
        'title' => $faker->paragraph,
        'description' => $faker->paragraph,
        'link' => $faker->url,
        'status' => 1
    ];
});
