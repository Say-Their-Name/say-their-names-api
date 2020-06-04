<?php

namespace App\Models\Traits;

use App\Models\Bookmarks;

trait HasBookmarks
{
    public function bookmarks()
    {
        return $this->hasMany(Bookmarks::class);
    }
}
