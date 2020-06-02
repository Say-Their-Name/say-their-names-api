<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Statics\Source;
use Faker\Generator as Faker;

$factory->define(Source::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'rss_feed_url' => $faker->url,
        'source_logo' => $faker->imageUrl(),
        'source_link' => $faker->url,
        'status' => 1
    ];
});
