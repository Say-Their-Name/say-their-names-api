<?php

namespace App\Models\Statics;

use App\Models\BaseModel;
use App\Models\Traits\Unguarded;

class Source extends BaseModel
{
    use Unguarded;

    protected $hidden = [
        'rss_feed_url',
        'status',
        'moderated_at',
        'moderated_by',
        'created_at',
        'updated_at',
    ];
}
