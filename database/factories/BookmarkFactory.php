<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Bookmarks as BookmarksAlias;
use App\Models\Person;
use App\User;
use Faker\Generator as Faker;

$factory->define(BookmarksAlias::class, function (Faker $faker) {
    return [
        'user_id' => factory(User::class),
        'person_id' => factory(Person::class),
    ];
});
