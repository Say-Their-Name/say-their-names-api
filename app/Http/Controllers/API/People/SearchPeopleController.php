<?php

namespace App\Http\Controllers\API\People;

use App\Http\Controllers\Controller;
use App\Models\Person;

class SearchPeopleController extends Controller
{
    public function __invoke($searchTerm)
    {
        return Person::query()
            ->where('full_name', 'LIKE', "%{$searchTerm}%")
            ->paginate();
    }
}
