<?php

namespace App\Models\Filters;

use App\Models\Statics\PetitionLinkTypes;
use EloquentFilter\ModelFilter;

class PetitionLinksFilter extends ModelFilter
{
    public $relations = [];

    public function type($type)
    {
        return $this->where('type_id', PetitionLinkTypes::fromName($type));
    }
}
