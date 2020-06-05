<?php

namespace App\Models\Statics;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Sushi\Sushi;

class DonationLinkTypes extends Model
{
    use Sushi;
    use Filterable;

    const VICTIMS = 1;
    const VICTIMS_TYPE = 'Victims';
    const PROTESTERS = 2;
    const PROTESTERS_TYPE = 'Protesters';
    const MOVEMENT = 3;
    const MOVEMENT_TYPE = 'Movement';

    protected $rows = [
        [
            'id' => self::VICTIMS,
            'type' => self::VICTIMS_TYPE,
        ],
        [
            'id' => self::PROTESTERS,
            'type' => self::PROTESTERS_TYPE,
        ],
        [
            'id' => self::MOVEMENT,
            'type' => self::MOVEMENT_TYPE,
        ],
    ];

    public static function fromName($name)
    {
        $linkType = null;

        switch (strtoupper($name)) {
            case Str::upper(self::VICTIMS_TYPE):
                $linkType = DonationLinkTypes::VICTIMS;
                break;
            case Str::upper(self::PROTESTERS_TYPE):
                $linkType = DonationLinkTypes::PROTESTERS;
                break;
            case Str::upper(self::MOVEMENT_TYPE):
                $linkType = DonationLinkTypes::MOVEMENT;
                break;
            default:
                $linkType = "";
        }

        return $linkType;
    }
}
