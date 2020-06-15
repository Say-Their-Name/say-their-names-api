<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Statics\DonationTypes;
use Faker\Generator as Faker;

$factory->define(DonationTypes::class, function (Faker $faker) {
    return [
        //
        'id' => 1,
    ];
});
