<?php

namespace App\Http\Controllers\API\Bookmarks;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookmarkResource;
use App\Models\Bookmarks;

class ListBookmarksController extends Controller
{
    public function __invoke()
    {

        $user = auth()->user();

        if ($user == null) {
            return response()->json(['error' => 'not_authenticated'], 401);
        }

        {
            $user_id = $user->getAuthIdentifier();
            return BookmarkResource::collection(Bookmarks::with('person')
                ->where('user_id', $user_id)
                ->paginate(config('say_thie_names.pagination', 10)));
        }

    }
}
