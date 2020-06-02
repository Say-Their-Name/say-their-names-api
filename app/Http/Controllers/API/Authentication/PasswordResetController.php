<?php

namespace App\Http\Controllers\API\Authentication;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResetPasswordRequest;

class PasswordResetController extends Controller
{
    public function __invoke(ResetPasswordRequest $request)
    {
        return response()->json('Success');
    }
}
