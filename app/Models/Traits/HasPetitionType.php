<?php

namespace App\Models\Traits;

use App\Models\Statics\PetitionLinkTypes;

trait HasPetitionType
{
    public function donationType()
    {
        return $this->belongsTo(PetitionLinkTypes::class);
    }
}
