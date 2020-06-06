<?php

namespace App\Http\Controllers\API\People;

use App\Http\Controllers\Controller;
use App\Http\Resources\PersonResource;
use App\Models\Person;
use Illuminate\Http\Request;

class ListPeopleController extends Controller
{
    public function __invoke(Request $request)
    {
        /**
        * @OA\Get(
        *     path="/api/people",
        *     tags={"people"},
        *     summary="Returns paginated list of People",
        *     description="Returns paginated list of People",
        *     operationId="getPeople",
    *      @OA\Response(response="200", description="Success")
        * )
        */
        return PersonResource::collection(Person::filter($request->all())
            ->with('images')
            ->orderBy('date_of_incident', 'DESC')
            ->paginateFilter());
    }
}
