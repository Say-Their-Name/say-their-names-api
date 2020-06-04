<?php

namespace App\Http\Controllers\API\Donations;

use App\Http\Controllers\Controller;
use App\Http\Resources\DonationLinkTypesResource;
use App\Models\Statics\DonationLinkTypes;

class ListDonationTypesController extends Controller
{
    public function __invoke()
    {
        return DonationLinkTypesResource::collection(DonationLinkTypes::all());
    }
}
