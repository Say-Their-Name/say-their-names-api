<?php

namespace App\Http\Controllers\API\Petitions;

use App\Http\Controllers\Controller;
use App\Http\Resources\PetitionResource;
use App\Models\PetitionLinks;

class ListPetitionsController extends Controller
{
    public function __invoke()
    {
        return PetitionResource::collection(PetitionLinks::with('person')->paginate(8));
    }
}
