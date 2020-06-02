<?php

namespace App\Models;

use App\Models\Traits\BelongsToPerson;
use App\Models\Traits\HasSource;

class MediaLinks extends BaseModel
{
    use BelongsToPerson;
    use HasSource;

    protected $with = ['source'];
}
