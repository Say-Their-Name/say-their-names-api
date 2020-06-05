<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\DonationLinks;
use App\Models\Person;
use App\Models\PetitionLinks;
use Illuminate\Http\Request;
use Spatie\Searchable\Search;

class SearchController extends Controller
{
    public function __invoke(Request $request)
    {
        $results = (new Search())
            ->registerModel(Person::class, ['full_name'])
            ->registerModel(DonationLinks::class, ['title', 'description', 'link'])
            ->registerModel(PetitionLinks::class, ['title', 'description', 'link'])
            ->search($request->input('query'));
        return response()->json([
            'data' => [
                'results' => $results
            ]
        ]);
    }
}
