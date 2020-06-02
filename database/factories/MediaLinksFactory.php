<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\MediaLinks;
use Faker\Generator as Faker;

$factory->define(MediaLinks::class, function (Faker $faker) {
    return [
        'url' => $faker->url,
        'status' => 1
    ];
});
