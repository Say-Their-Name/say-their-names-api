<?php

namespace App\Http\Controllers\API\Donations;

use App\Http\Controllers\Controller;
use App\Models\DonationLinks;

class GetSingleDonationController extends Controller
{
    public function __invoke($donation)
    {
        return DonationLinks::withPerson()->find($donation);
    }
}
