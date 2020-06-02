<?php

namespace App\Http\Controllers\API\Authentication;

use App\Http\Controllers\Controller;
use App\Http\Requests\RequestPasswordResetRequest;

class RequestPasswordResetController extends Controller
{
    public function __invoke(RequestPasswordResetRequest $request)
    {
        return response()->json('Reset Email Has Been Sent');

    }
}
