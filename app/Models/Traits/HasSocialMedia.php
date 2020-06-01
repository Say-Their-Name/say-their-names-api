<?php

namespace App\Models\Traits;

use App\Models\SocialMedia;

trait HasSocialMedia
{
    public function socialMedia()
    {
        return $this->hasMany(SocialMedia::class);
    }
}
