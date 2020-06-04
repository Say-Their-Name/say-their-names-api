<?php

namespace App\Http\Controllers\API\Petitions;

use App\Http\Controllers\Controller;
use App\Http\Resources\PetitionLinkTypesResource;
use App\Models\Statics\PetitionLinkTypes;

class ListPetitionTypesController extends Controller
{
    public function __invoke()
    {
        return PetitionLinkTypesResource::collection(PetitionLinkTypes::all());
    }
}
