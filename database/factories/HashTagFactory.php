<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\HashTag;
use Faker\Generator as Faker;

$factory->define(HashTag::class, function (Faker $faker) {
    return [
        'tag' => '#placeholder',
        'link' => $faker->url,
        'status' => 1
    ];
});
