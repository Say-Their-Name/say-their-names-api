<?php

namespace App\Http\Controllers\API\People;

use App\Http\Controllers\Controller;
use App\Http\Resources\PersonResource;
use App\Models\Person;

class GetSinglePersonController extends Controller
{
    /**
     * @OA\Get(
     *    path="/api/people/{firstname-lastname}",
     *    tags={"people"},
     *    summary="Search People by identifier",
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
     *     @OA\Response(
     *       response="200",
     *       description="Success",
     *       @OA\JsonContent(
     *         type="object",
     *         @OA\Property(type="integer", property="id"),
     *         @OA\Property(type="string", property="full_name"),
     *         @OA\Property(type="string", property="identifier"),
     *         @OA\Property(type="date", property="date_of_incident"),
     *         @OA\Property(type="integer", property="number_of_children"),
     *         @OA\Property(type="integer", property="age"),
     *         @OA\Property(type="string", property="city"),
     *         @OA\Property(type="string", property="country"),
     *         @OA\Property(type="string", property="context"),
     *         @OA\Property(type="array", property="images",
     *           @OA\Items(
     *              type="object",
     *              @OA\Property(type="integer", property="id"),
     *              @OA\Property(type="integer", property="person_id"),
     *              @OA\Property(type="string", property="image_url")
     *           )
     *         ),
     *         @OA\Property(type="array", property="donation_links",
     *           @OA\Items(
     *              type="object",
     *              @OA\Property(type="integer", property="id"),
     *              @OA\Property(type="string", property="identifier"),
     *              @OA\Property(type="string", property="title"),
     *              @OA\Property(type="string", property="description"),
     *              @OA\Property(type="string", property="outcome"),
     *              @OA\Property(type="string", property="link"),
     *              @OA\Property(type="string", property="outcome_img_url"),
     *              @OA\Property(type="string", property="banner_img_url")
     *           )
     *         ),
     *         @OA\Property(type="array", property="petition_links",
     *           @OA\Items(
     *              type="object",
     *              @OA\Property(type="integer", property="id"),
     *              @OA\Property(type="string", property="identifier"),
     *              @OA\Property(type="string", property="title"),
     *              @OA\Property(type="string", property="description"),
     *              @OA\Property(type="string", property="outcome"),
     *              @OA\Property(type="string", property="link"),
     *              @OA\Property(type="string", property="outcome_img_url"),
     *              @OA\Property(type="string", property="banner_img_url")
     *           )
     *         ),
     *         @OA\Property(type="array", property="media_links",
     *           @OA\Items(
     *              type="object",
     *              @OA\Property(type="string", property="url")
     *           )
     *         ),
     *       )
     *     ),
     * )
     * @param $person
     * @return PersonResource
     */
    public function __invoke($person)
    {
        return new PersonResource(
            Person::complete()
                ->where('identifier', $person)->firstOrFail()
        );
    }
}
