<?php

namespace App\Http\Controllers\API\People;

use App\Http\Controllers\Controller;
use App\Http\Resources\PersonResource;
use App\Models\Person;

class GetSinglePersonController extends Controller
{
    public function __invoke($person)
    {
        return new PersonResource(
            Person::complete()
                ->where('identifier', $person)->first()
        );
    }
}
