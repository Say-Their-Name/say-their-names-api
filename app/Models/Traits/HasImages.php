<?php

namespace App\Models\Traits;

use App\Models\PersonImages;

trait HasImages
{
    public function images()
    {
        return $this->hasMany(PersonImages::class);
    }
}
