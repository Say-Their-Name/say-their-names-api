<?php

namespace App\Models;

use App\Casts\SharableLinksCast;
use App\Models\Objects\SharableLinks;
use App\Models\Traits\BelongsToPerson;
use App\Models\Traits\HasDonationType;
use App\Models\Traits\HasHashTags;
use EloquentFilter\Filterable;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class DonationLink extends BaseModel implements Searchable
{
    use BelongsToPerson;
    use HasDonationType;
    use HasHashTags;
    use Filterable;
    use HasSlug;

    const SLUG = 'identifier';

    protected $casts = [
        'sharable_links' => SharableLinksCast::class,
    ];

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

    protected static function booted()
    {
        static::saving(function ($model) {
            $base = "https://www.saythiernames.io/donations/$model->identifier";
            $model->sharable_links = new SharableLinks([
                'base' => $base,
                'facebook' => "https://www.facebook.com/sharer/sharer.php?u=$base",
                'twitter' => "https://twitter.com/home?status=$base",
                'whatsapp' => "https://wa.me/?text=$base"
            ]);
        });
    }
}
