<?php

namespace App\Models\Traits;

use App\Models\Person;

trait BelongsToPerson
{
    public function person()
    {
        return $this->belongsTo(Person::class);
    }

    public function scopeWithPerson($query)
    {
        return $query->with('person');
    }
}
