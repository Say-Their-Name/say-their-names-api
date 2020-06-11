<?php

namespace App\Http\Controllers\API\Donations;

use App\Http\Controllers\Controller;
use App\Http\Resources\DonationResource;
use App\Models\DonationLink;

class GetSingleDonationController extends Controller
{
    public function __invoke($donation)
    {
        return new DonationResource(
            DonationLink::with(['person', 'hashTags', 'type'])
                ->where(DonationLink::SLUG, $donation)
                ->firstOrFail()
        );
    }
}
