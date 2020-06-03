<?php

namespace App\Http\Controllers\API\Donations;

use App\Http\Controllers\Controller;
use App\Http\Resources\DonationResource;
use App\Models\DonationLinks;

class GetSingleDonationController extends Controller
{
    public function __invoke($donation)
    {
        return new DonationResource(DonationLinks::with(['person'])->find($donation));
    }
}
