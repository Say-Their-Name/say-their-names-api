<?php

namespace App\Models\Traits;

use App\Models\PetitionLinks;

trait HasPetitions
{
    public function petitionLinks()
    {
        return $this->hasMany(PetitionLinks::class);
    }
}
