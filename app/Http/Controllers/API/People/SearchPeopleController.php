<?php

namespace App\Http\Controllers\API\People;

use App\Http\Controllers\Controller;
use App\Models\Person;

class SearchPeopleController extends Controller
{
/**
* @OA\Get(
*    path="/api/people/search/{term}",
*    tags={"people"},
*    summary="Search term in Full Name",
*    operationId="getUserByName",
*    @OA\Parameter(
*         name="term",
*         in="path",
*         required=true,
*         @OA\Schema(
*             type="string"
*         ),
*         example="george"
*     ),
*     @OA\Response(response="200", description="Search People"),
* )
*/
    public function __invoke($searchTerm)
    {
        return Person::query()
            ->where('full_name', 'LIKE', "%{$searchTerm}%")
            ->paginate();
    }
}
