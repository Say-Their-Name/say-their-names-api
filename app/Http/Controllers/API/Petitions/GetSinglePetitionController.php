<?php

namespace App\Http\Controllers\API\Petitions;

use App\Http\Controllers\Controller;
use App\Http\Resources\PetitionResource;
use App\Models\PetitionLinks;

class GetSinglePetitionController extends Controller
{
    public function __invoke($petition)
    {
        return new PetitionResource(PetitionLinks::with(['person'])
            ->findOrFail($petition));
    }
}
