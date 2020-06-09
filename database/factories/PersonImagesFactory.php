<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\PersonImages;
use Faker\Generator as Faker;

$factory->define(PersonImages::class, function (Faker $faker) {
    return [
        'image_url' => $faker->imageUrl(),
        'status' => 1,
    ];
});
