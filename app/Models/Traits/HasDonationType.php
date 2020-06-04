<?php

namespace App\Models\Traits;

use App\Models\Statics\DonationLinkTypes;

trait HasDonationType
{
    public function donationType()
    {
        return $this->belongsTo(DonationLinkTypes::class);
    }
}
