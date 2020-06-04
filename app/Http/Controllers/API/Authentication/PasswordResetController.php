<?php

namespace App\Http\Controllers\API\Authentication;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;

class PasswordResetController extends Controller
{
    use ResetsPasswords;

    protected function rules()
    {
        return [
            'token' => 'required',
            'email' => [
                'required',
                'email',
                'exists:users'
            ],
            'password' => [
                'required',
                'confirmed',
                'min:6'
            ],
        ];
    }

    protected function sendResetResponse(Request $request, $response)
    {
        return ['status' => trans($response)];
    }

    protected function sendResetFailedResponse(Request $request, $response)
    {
        return response()->json(['email' => trans($response)], 400);
    }
}
