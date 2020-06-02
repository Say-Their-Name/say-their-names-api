<?php

namespace App\Models\Filters;

use EloquentFilter\ModelFilter;

class PersonFilter extends ModelFilter
{
    /**
    * Related Models that have ModelFilters as well as the method on the ModelFilter
    * As [relationMethod => [input_key1, input_key2]].
    *
    * @var array
    */
    public $relations = [];

    public function country($country)
    {
        return $this->where('country', $country);
    }

    public function city($city)
    {
        return $this->where('city', $city);
    }
}
