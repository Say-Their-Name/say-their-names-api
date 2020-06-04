<?php

namespace App\Models;

use App\Models\Traits\BelongsToPerson;
use App\Models\Traits\HasPetitionType;
use EloquentFilter\Filterable;

class PetitionLinks extends BaseModel
{
    use BelongsToPerson;
    use HasPetitionType;
    use Filterable;
}
