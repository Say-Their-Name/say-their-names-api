<?php

namespace App\Models\Traits;

use App\Models\Statics\PetitionLinkTypes;

trait HasPetitionType
{
    public function type()
    {
        return $this->belongsTo(PetitionLinkTypes::class, 'type_id');
    }
}
