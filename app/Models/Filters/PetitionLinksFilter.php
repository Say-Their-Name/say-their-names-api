<?php

namespace App\Models\Filters;

use App\Models\Filters\Traits\FilterableByPerson;
use App\Models\Statics\PetitionLinkTypes;
use EloquentFilter\ModelFilter;

class PetitionLinksFilter extends ModelFilter
{
    use FilterableByPerson;

    public $relations = [];

    public function type($type)
    {
        return $this->where('type_id', PetitionLinkTypes::fromName($type));
    }
}
