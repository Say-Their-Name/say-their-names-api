<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Objects\SharableLinks;
use App\Models\Person;
use Faker\Generator as Faker;

$factory->define(Person::class, function (Faker $faker) {
    return [
        'full_name' => $faker->firstName . ' ' . $faker->lastName,
        'date_of_incident' => $faker->date(),
        'number_of_children' => $faker->numberBetween(1, 10),
        'age' => 20,
        'city' => $faker->city,
        'country' => $faker->country,
        'biography' => $faker->paragraph,
        'context' => $faker->paragraph,
        'status' => 1,
    ];
});


$factory->state(Person::class, 'withSharableLinks', function (Faker $faker) {
    return [
        'sharable_links' => new SharableLinks([
            'base' => $faker->url,
            'facebook' => $faker->url,
            'twitter' => $faker->url,
            'whatsapp' => $faker->url,
        ])
    ];
});