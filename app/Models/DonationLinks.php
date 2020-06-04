<?php

namespace App\Models;

use App\Models\Traits\BelongsToPerson;
use App\Models\Traits\HasDonationType;
use EloquentFilter\Filterable;

class DonationLinks extends BaseModel
{
    use BelongsToPerson;
    use HasDonationType;
    use Filterable;
}
