<?php

namespace App\Models\Filters;

use App\Models\Statics\DonationLinkTypes;
use EloquentFilter\ModelFilter;

class DonationLinksFilter extends ModelFilter
{
    public $relations = [];

    public function type($type)
    {
        return $this->where('type_id', DonationLinkTypes::fromName($type));
    }
}
