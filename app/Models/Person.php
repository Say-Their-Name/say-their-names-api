<?php

namespace App\Models;

use App\Models\Traits\HasDonations;
use App\Models\Traits\HasMedia;
use App\Models\Traits\HasPetitions;
use App\Models\Traits\HasSocialMedia;
use App\Models\Traits\Unguarded;
use Carbon\Carbon;

class Person extends BaseModel
{
    use Unguarded;
    use HasPetitions;
    use HasDonations;
    use HasMedia;
    use HasSocialMedia;

    protected $appends = [
        'age',
    ];

    public function getAgeAttribute($value)
    {
        return Carbon::parse($this->date_of_birth)->age;
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
            'socialMedia'
        ]);
    }
}
