<?php

namespace App\Models\Traits;

use App\Models\HashTag;

trait HasHashTags
{
    public function hashTags()
    {
        return $this->morphMany(HashTag::class, 'taggable');
    }
}
