<?php

namespace App\Http\Controllers\API\Donations;

use App\Http\Controllers\Controller;
use App\Models\DonationLinks;

class ListDonationsController extends Controller
{
    public function __invoke()
    {
        return DonationLinks::withPerson()->get();
    }
}
