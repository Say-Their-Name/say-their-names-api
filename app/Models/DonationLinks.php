<?php

namespace App\Models;

use App\Models\Traits\BelongsToPerson;
use App\Models\Traits\HasDonationType;
use EloquentFilter\Filterable;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class DonationLinks extends BaseModel implements Searchable
{
    use BelongsToPerson;
    use HasDonationType;
    use Filterable;

    public function getSearchResult(): SearchResult
    {
        return new SearchResult($this, $this->id);
    }
}
