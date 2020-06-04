<?php

namespace App\Models\Statics;

use Illuminate\Database\Eloquent\Model;
use Sushi\Sushi;

class PetitionLinkTypes extends Model
{
    use Sushi;

    const FOR_VICTIMS = 1;
    const FOR_POLICY = 2;

    protected $rows = [
        [
            'id' => self::FOR_VICTIMS,
            'type' => 'Victims',
        ],
        [
            'id' => self::FOR_POLICY,
            'type' => 'Legal and Policy',
        ],
    ];
}
