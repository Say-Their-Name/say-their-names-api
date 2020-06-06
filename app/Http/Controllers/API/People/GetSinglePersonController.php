<?php

namespace App\Http\Controllers\API\People;

use App\Http\Controllers\Controller;
use App\Http\Resources\PersonResource;
use App\Models\Person;

class GetSinglePersonController extends Controller
{
/**
* @OA\Get(
*    path="/api/people/{id}",
*    tags={"people"},
*    summary="Search People by id",
*    operationId="getUserByID",
*    @OA\Parameter(
*         name="id",
*         in="path",
*         required=true,
*         @OA\Schema(
*             type="integer"
*         ),
*         example="1"
*     ),
*     @OA\Response(response="200", description="Success"),
* )
*/
    public function __invoke($person)
    {
        return new PersonResource(
            Person::complete()
                ->where('identifier', $person)->firstOrFail()
        );
    }
}
