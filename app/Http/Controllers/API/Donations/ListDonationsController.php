<?php

namespace App\Http\Controllers\API\Donations;

use App\Http\Controllers\Controller;
use App\Http\Resources\DonationResource;
use App\Models\DonationLinks;
use Illuminate\Http\Request;

class ListDonationsController extends Controller
{
    public function __invoke(Request $request)
    {
        return DonationResource::collection(DonationLinks::filter($request->all())
            ->with(['person', 'type'])
            ->paginateFilter());
    }
}
