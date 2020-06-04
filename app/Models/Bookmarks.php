<?php

namespace App\Models;

use App\Models\Traits\BelongsToPerson;
use App\Models\Traits\BelongsToUser;
use Illuminate\Database\Eloquent\Model;

class Bookmarks extends Model
{
    use BelongsToUser;
    use BelongsToPerson;
}
