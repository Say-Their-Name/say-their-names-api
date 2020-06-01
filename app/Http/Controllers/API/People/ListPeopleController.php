<?php

namespace App\Http\Controllers\API\People;

use App\Http\Controllers\Controller;
use App\Models\Person;

class ListPeopleController extends Controller
{
    public function __invoke()
    {
        return Person::with('images')->get();
    }
}
