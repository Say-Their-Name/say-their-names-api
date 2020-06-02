<?php

namespace App\Http\Controllers\API\People;

use App\Http\Controllers\Controller;
use App\Models\Person;

class ListPeopleByCityController extends Controller
{
    public function __invoke($city)
    {
        return Person::with('images')
            ->where('city', $city)
            ->paginate(8);
    }
}
