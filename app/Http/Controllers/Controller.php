<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests;
    use DispatchesJobs;
    use ValidatesRequests;
}

/**
 * @OA\Info(
 *     version="1.0",
 *     title="Say Their Name API",
 * description="Find our more here: [https://github.com/Say-Their-Name/api](https://github.com/Say-Their-Name/api)"
 * )
 */
/**
* @OA\Tag(
*     name="people",
*     description="Find People",
* )
*/
