<?php

namespace App\Http\Controllers\API\Bookmarks;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookmarkResource;
use App\Models\Bookmarks;

class ListBookmarksController extends Controller
{
    public function __invoke()
    {
        return BookmarkResource::collection(Bookmarks::with('person')
            ->where('user_id', auth()->user()->getAuthIdentifier)
            ->paginate());
    }
}
