<?php

namespace App\Models;

use App\Models\Traits\HasBookmarks;
use App\Models\Traits\HasDonations;
use App\Models\Traits\HasMedia;
use App\Models\Traits\HasPetitions;
use App\Models\Traits\HasSocialMedia;
use App\Models\Traits\Unguarded;
use EloquentFilter\Filterable;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Person extends BaseModel
{
    use Unguarded;
    use HasPetitions;
    use HasDonations;
    use HasMedia;
    use HasSocialMedia;
    use HasBookmarks;
    use Filterable;
    use HasSlug;

    const SLUG = 'identifier';

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
            'socialMedia',
        ]);
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('full_name')
            ->saveSlugsTo(self::SLUG);
    }
}
