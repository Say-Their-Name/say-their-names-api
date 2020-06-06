<?php

namespace App\Models\Filters\Traits;

use App\Models\Person;

trait FilterableByPerson
{
    public function name($name)
    {
        return $this->whereHas('person', function ($q) use ($name) {
            $q->where(Person::SLUG, $name);
        })->get();
    }
}
