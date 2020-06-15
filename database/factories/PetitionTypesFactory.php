<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Statics\PetitionTypes;
use Faker\Generator as Faker;

$factory->define(PetitionTypes::class, function (Faker $faker) {
    return [
        //
        'id' => 1,
    ];
});
