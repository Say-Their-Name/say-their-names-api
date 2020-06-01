<?php

namespace App\Models;

use App\Models\Traits\Unguarded;
use Hootlex\Moderation\Moderatable;
use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    use Unguarded;
    use Moderatable;

    protected $hidden = [
        'created_at',
        'updated_at',
        'status',
        'moderated_at',
        'moderated_by',
    ];
}
