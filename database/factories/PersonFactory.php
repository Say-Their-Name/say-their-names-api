<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Person;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(Person::class, function (Faker $faker) {
    $date = $faker->dateTimeThisCentury(now()->subYears(7));
    return [
        'full_name' => $faker->firstName . ' ' . $faker->lastName,
        'date_of_birth' => $date,
        'date_of_incident' => $faker->dateTimeThisDecade(),
        'number_of_children' => $faker->numberBetween(1, 10),
        'age' => Carbon::parse($date)->age,
        'city' => $faker->city,
        'country' => $faker->country,
        'biography' => $faker->paragraph,
        'context' => $faker->paragraph,
        'status' => 1
    ];
});
