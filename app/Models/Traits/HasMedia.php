<?php

namespace App\Models\Traits;

use App\Models\MediaLinks;

trait HasMedia
{
    public function mediaLinks()
    {
        return $this->hasMany(MediaLinks::class);
    }
}
