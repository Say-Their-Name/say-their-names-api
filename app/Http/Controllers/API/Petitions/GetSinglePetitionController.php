<?php


namespace App\Http\Controllers\API\Petitions;


use App\Http\Controllers\Controller;
use App\Models\PetitionLinks;

class GetSinglePetitionController extends Controller
{
    public function __invoke($petition)
    {
        return PetitionLinks::withPerson()->find($petition);
    }

}
