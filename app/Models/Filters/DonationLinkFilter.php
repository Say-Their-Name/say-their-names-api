<?php

namespace App\Models\Filters;

use App\Models\Filters\Traits\FilterableByPerson;
use App\Models\Statics\DonationLinkTypes;
use EloquentFilter\ModelFilter;

class DonationLinkFilter extends ModelFilter
{
    use FilterableByPerson;

    public $relations = [];

    public function type($type)
    {
        return $this->where('type_id', DonationLinkTypes::fromName($type));
    }
}
