<?php

namespace App\Http\Controllers\API\Petitions;

use App\Http\Controllers\Controller;
use App\Models\PetitionLinks;

class ListPetitionsController extends Controller
{
    public function __invoke()
    {
        return PetitionLinks::withPerson()->get();
    }
}
