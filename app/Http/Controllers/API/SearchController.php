<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\SearchRequest;
use App\Models\DonationLink;
use App\Models\Person;
use App\Models\PetitionLink;
use Spatie\Searchable\Search;

class SearchController extends Controller
{
    public function __invoke(SearchRequest $request)
    {
        $results = (new Search())
            ->registerModel(Person::class, ['full_name'])
            ->registerModel(DonationLink::class, ['title', 'description', 'link'])
            ->registerModel(PetitionLink::class, ['title', 'description', 'link'])
            ->search($request->input('query'));
        return response()->json([
            'data' => [
                'results' => $results
            ]
        ]);
    }
}
