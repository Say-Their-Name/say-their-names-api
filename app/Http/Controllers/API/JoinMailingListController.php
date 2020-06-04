<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\MailingListRequest;

class JoinMailingListController extends Controller
{
    public function __invoke(MailingListRequest $request)
    {
        return response()->json([
            'data' => [
                'status' => 'success',
            ],
        ]);
    }
}
