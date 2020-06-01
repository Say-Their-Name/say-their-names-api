<?php

namespace App\Models\Traits;

use App\Models\DonationLinks;

trait HasDonations
{
    public function donationLinks()
    {
        return $this->hasMany(DonationLinks::class);
    }
}
