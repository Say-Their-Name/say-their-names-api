<?php

namespace App\Models\Traits;

use App\Models\Statics\DonationLinkTypes;

trait HasDonationType
{
    public function type()
    {
        return $this->belongsTo(DonationLinkTypes::class, 'type_id');
    }
}
