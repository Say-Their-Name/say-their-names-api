<?php

namespace App\Http\Controllers\API\Petitions;

use App\Http\Controllers\Controller;
use App\Http\Resources\PetitionResource;
use App\Models\PetitionLink;

class GetSinglePetitionController extends Controller
{
    public function __invoke($petition)
    {
        return new PetitionResource(
            PetitionLink::with(['person', 'hashTags', 'type'])
                ->where('identifier', $petition)
                ->firstOrFail()
        );
    }
}
