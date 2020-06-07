<?php

namespace App\Models;

use App\Models\Traits\BelongsToPerson;
use App\Models\Traits\HasDonationType;
use App\Models\Traits\HasHashTags;
use EloquentFilter\Filterable;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class DonationLinks extends BaseModel implements Searchable
{
    use BelongsToPerson;
    use HasDonationType;
    use HasHashTags;
    use Filterable;
    use HasSlug;

    const SLUG = 'identifier';

    public function getSearchResult(): SearchResult
    {
        return new SearchResult($this, $this->id);
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo(self::SLUG);
    }
}
