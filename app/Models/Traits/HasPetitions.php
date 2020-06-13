<?php

namespace App\Models\Traits;

use App\Models\PetitionLink;

trait HasPetitions
{
    public function petitionLinks()
    {
        return $this->hasMany(PetitionLink::class);
    }
}
