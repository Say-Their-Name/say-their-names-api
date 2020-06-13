<?php

namespace App\Http\Controllers\API\Petitions;

use App\Http\Controllers\Controller;
use App\Http\Resources\PetitionResource;
use App\Models\PetitionLink;
use Illuminate\Http\Request;

class ListPetitionsController extends Controller
{
    public function __invoke(Request $request)
    {
        return PetitionResource::collection(PetitionLink::filter($request->all())
            ->with(['person', 'type'])
            ->paginateFilter());
    }
}
