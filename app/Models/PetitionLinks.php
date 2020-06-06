<?php

namespace App\Models;

use App\Models\Traits\BelongsToPerson;
use App\Models\Traits\HasHashTags;
use App\Models\Traits\HasPetitionType;
use EloquentFilter\Filterable;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class PetitionLinks extends BaseModel implements Searchable
{
    use BelongsToPerson;
    use HasPetitionType;
    use HasHashTags;
    use Filterable;

    public function getSearchResult(): SearchResult
    {
        return new SearchResult($this, $this->id);
    }
}
