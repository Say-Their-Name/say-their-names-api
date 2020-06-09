<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookmarkResource;
use App\Models\Bookmarks;
use Illuminate\Http\Request;

class ListProfileBookmarks extends Controller
{
    public function __invoke(Request $request)
    {
        return BookmarkResource::collection(Bookmarks::with('person')
            ->where('user_id', auth()->user()->getAuthIdentifier)
            ->paginate());
    }
}
