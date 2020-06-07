<?php

namespace App\Models;

use App\Models\Traits\HasBookmarks;
use App\Models\Traits\HasDonations;
use App\Models\Traits\HasHashTags;
use App\Models\Traits\HasMedia;
use App\Models\Traits\HasPetitions;
use App\Models\Traits\Unguarded;
use EloquentFilter\Filterable;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Person extends BaseModel implements Searchable
{
    use Unguarded;
    use HasPetitions;
    use HasDonations;
    use HasMedia;
    use HasHashTags;
    use HasBookmarks;
    use Filterable;
    use HasSlug;

    public $casts = [
        'number_of_children' => 'int',
        'age' => 'int',
    ];

    const SLUG = 'identifier';

    public function getSearchResult(): SearchResult
    {
        return new SearchResult($this, $this->identifier);
    }

    public function images()
    {
        return $this->hasMany(PersonImages::class);
    }

    public function scopeComplete($query)
    {
        return $query->with([
            'donationLinks',
            'petitionLinks',
            'mediaLinks',
            'images',
            'hashTags',
        ]);
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('full_name')
            ->saveSlugsTo(self::SLUG);
    }
}
