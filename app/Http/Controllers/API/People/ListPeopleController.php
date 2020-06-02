<?php

namespace App\Http\Controllers\API\People;

use App\Http\Controllers\Controller;
use App\Http\Resources\PersonResource;
use App\Models\Person;

class ListPeopleController extends Controller
{
    public function __invoke()
    {
        return PersonResource::collection(Person::with('images')->paginate(8));
    }
}
