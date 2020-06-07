<?php

namespace App\Http\Controllers\API\People;

use App\Http\Controllers\Controller;
use App\Http\Resources\PersonResource;
use App\Models\Person;
use Illuminate\Http\Request;

class ListPeopleController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/people",
     *     tags={"people"},
     *     summary="Returns paginated list of People",
     *     description="Returns paginated list of People",
     *     operationId="getPeople",
     *     @OA\Response(
     *       response="200",
     *       description="Success",
     *       @OA\JsonContent(
     *         type="object",
     *         @OA\Property(type="object", property="links",
     *           @OA\Property(type="string", property="first"),
     *           @OA\Property(type="string", property="last"),
     *           @OA\Property(type="string", property="prev"),
     *           @OA\Property(type="string", property="next")
     *         ),
     *         @OA\Property(type="object", property="meta",
     *           @OA\Property(type="integer", property="current_page"),
     *           @OA\Property(type="integer", property="from"),
     *           @OA\Property(type="integer", property="last_page"),
     *           @OA\Property(type="string", property="path"),
     *           @OA\Property(type="integer", property="per_page"),
     *           @OA\Property(type="integer", property="to"),
     *           @OA\Property(type="integer", property="total")
     *         ),
     *         @OA\Property(type="array", property="data",
     *           @OA\Items(type="object",
     *             @OA\Property(type="integer", property="id"),
     *             @OA\Property(type="string", property="full_name"),
     *             @OA\Property(type="string", property="identifier"),
     *             @OA\Property(type="date", property="date_of_incident"),
     *             @OA\Property(type="integer", property="number_of_children"),
     *             @OA\Property(type="integer", property="age"),
     *             @OA\Property(type="string", property="city"),
     *             @OA\Property(type="string", property="country"),
     *             @OA\Property(type="string", property="context"),
     *             @OA\Property(type="array", property="images",
     *               @OA\Items(
     *                  type="object",
     *                  @OA\Property(type="integer", property="id"),
     *                  @OA\Property(type="integer", property="person_id"),
     *                  @OA\Property(type="string", property="image_url")
     *               )
     *             ),
     *             @OA\Property(type="array", property="donation_links",
     *               @OA\Items(
     *                  type="object",
     *                  @OA\Property(type="integer", property="id"),
     *                  @OA\Property(type="string", property="identifier"),
     *                  @OA\Property(type="string", property="title"),
     *                  @OA\Property(type="string", property="description"),
     *                  @OA\Property(type="string", property="outcome"),
     *                  @OA\Property(type="string", property="link"),
     *                  @OA\Property(type="string", property="outcome_img_url"),
     *                  @OA\Property(type="string", property="banner_img_url")
     *               )
     *             ),
     *             @OA\Property(type="array", property="petition_links",
     *               @OA\Items(
     *                  type="object",
     *                  @OA\Property(type="integer", property="id"),
     *                  @OA\Property(type="string", property="identifier"),
     *                  @OA\Property(type="string", property="title"),
     *                  @OA\Property(type="string", property="description"),
     *                  @OA\Property(type="string", property="outcome"),
     *                  @OA\Property(type="string", property="link"),
     *                  @OA\Property(type="string", property="outcome_img_url"),
     *                  @OA\Property(type="string", property="banner_img_url")
     *               )
     *             ),
     *             @OA\Property(type="array", property="media_links",
     *               @OA\Items(
     *                  type="object",
     *                  @OA\Property(type="string", property="url")
     *               )
     *             ),
     *           )
     *         )
     *       )
     *     ),
     * )
     */
    public function __invoke(Request $request)
    {

        return PersonResource::collection(Person::filter($request->all())
            ->with('images')
            ->orderBy('date_of_incident', 'DESC')
            ->paginateFilter());
    }
}
