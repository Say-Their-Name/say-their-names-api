<?php

namespace App\Models;

use App\Models\Traits\BelongsToPerson;

class PersonImages extends BaseModel
{
    // Note: without this, person_id ends up being a string in JSON and breaks the clients. 
    // Couldn't figure out why it's not an integer like other foreign keys.
    protected $casts = [
        'person_id' => 'integer',
    ];

    use BelongsToPerson;
}
