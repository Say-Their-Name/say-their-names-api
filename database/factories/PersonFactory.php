<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Person;
use Faker\Generator as Faker;

$factory->define(Person::class, function (Faker $faker) {
    return [
        'full_name' => $faker->firstName . ' ' . $faker->lastName,
        'date_of_birth' => $faker->dateTimeThisCentury(now()->subYears(7)),
        'date_of_incident' => $faker->dateTimeThisDecade(),
        'number_of_children' => $faker->numberBetween(1, 10),
        'location' => $faker->city,
        'biography' => $faker->paragraph,
        'context' => $faker->paragraph,
    ];
});
