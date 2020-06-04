<?php

namespace App\Models\Traits;

use App\User;

trait BelongsToUser
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeWithUser($query)
    {
        return $query->with('user');
    }
}
