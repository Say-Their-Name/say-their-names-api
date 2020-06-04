<?php

namespace App\Models\Statics;

use Illuminate\Database\Eloquent\Model;
use Sushi\Sushi;

class DonationLinkTypes extends Model
{
    use Sushi;

    const VICTIMS = 1;
    const PROTESTERS = 2;
    const MOVEMENT = 3;

    protected $rows = [
        [
            'id' => self::VICTIMS,
            'type' => 'Victims',
        ],
        [
            'id' => self::PROTESTERS,
            'type' => 'Protesters',
        ],
        [
            'id' => self::MOVEMENT,
            'type' => 'Movement',
        ],
    ];
}
