<?php

namespace App\Models\Statics;

use App\Utils\TypeUtils;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;
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

    const TYPES = [
        self::VICTIMS_TYPE => self::VICTIMS,
        self::PROTESTERS_TYPE => self::PROTESTERS,
        self::MOVEMENT_TYPE => self::MOVEMENT,
    ];

    protected $rows;

    public static function fromName($name)
    {
        return TypeUtils::getTypeId($name, self::TYPES);
    }

    public static function getRows()
    {
        return TypeUtils::typeMapToRows(self::TYPES);
    }
}
