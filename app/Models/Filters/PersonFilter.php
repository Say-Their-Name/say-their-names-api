<?php

namespace App\Models\Filters;

use EloquentFilter\ModelFilter;

class PersonFilter extends ModelFilter
{
    public $relations = [];

    public function country($country)
    {
        return $this->where('country', $country);
    }

    public function city($city)
    {
        return $this->where('city', $city);
    }

    public function name($name)
    {
        return $this->where('full_name', 'LIKE', '%' . $name . '%');
    }
}
