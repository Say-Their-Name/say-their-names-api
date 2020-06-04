<?php

namespace App\Http\Controllers\API\Donations;

use App\Http\Controllers\Controller;
use App\Http\Resources\DonationResource;
use App\Models\DonationLinks;

class ListDonationsController extends Controller
{
    public function __invoke()
    {
        return DonationResource::collection(DonationLinks::with('person')->paginate());
    }
}
