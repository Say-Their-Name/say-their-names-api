<?php

namespace App\Models;

use App\Casts\SharableLinksCast;
use App\Models\Objects\SharableLinks;
use App\Models\Traits\BelongsToPerson;
use App\Models\Traits\HasDonationType;
use App\Models\Traits\HasHashTags;
use EloquentFilter\Filterable;
use Illuminate\Support\Str;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class DonationLink extends BaseModel implements Searchable
{
    use BelongsToPerson;
    use HasDonationType;
    use HasHashTags;
    use Filterable;

    const SLUG = 'identifier';

    protected $casts = [
        'sharable_links' => SharableLinksCast::class,
    ];

    public function getSearchResult(): SearchResult
    {
        return new SearchResult($this, $this->id);
    }

    protected static function booted()
    {
        static::saving(function ($model) {
            $model->identifier = Str::slug($model->title);
            $base = "https://www.saytheirnames.io/donate/{$model->identifier}";
            $model->sharable_links = new SharableLinks([
                'base' => $base,
                'facebook' => "https://www.facebook.com/sharer/sharer.php?u=${base}",
                'twitter' => "https://twitter.com/home?status=${base}",
                'whatsapp' => "https://wa.me/?text=${base}",
            ]);
        });
    }
}
