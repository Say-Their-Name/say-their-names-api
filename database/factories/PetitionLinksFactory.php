<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\PetitionLink;
use Faker\Generator as Faker;

$factory->define(PetitionLink::class, function (Faker $faker) {
    return [
        'title' => 'Lorem Ipsum Fund',
        'description' => $faker->paragraph,
        'link' => $faker->url,
        'outcome' => $faker->paragraph,
        'banner_img_url' => 'https://saytheirnames.dev/images/assets/petition_banner.jpg',
        'outcome_img_url' => 'https://saytheirnames.dev/images/assets/petition_banner.jpg',
        'status' => 1,
    ];
});
