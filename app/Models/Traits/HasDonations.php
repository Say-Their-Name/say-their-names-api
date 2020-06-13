<?php

namespace App\Models\Traits;

use App\Models\DonationLink;

trait HasDonations
{
    public function donationLinks()
    {
        return $this->hasMany(DonationLink::class);
    }
}
