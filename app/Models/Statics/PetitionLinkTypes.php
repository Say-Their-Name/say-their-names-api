<?php

namespace App\Models\Statics;

use App\Utils\TypeUtils;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;
use Sushi\Sushi;

class PetitionLinkTypes extends Model
{
    use Sushi;
    use Filterable;

    const FOR_VICTIMS = 1;
    const FOR_VICTIM_TYPE = 'Victims';
    const FOR_POLICY = 2;
    const FOR_POLICY_TYPE = 'Policy';

    const TYPES = [
        self::FOR_VICTIM_TYPE => self::FOR_VICTIMS,
        self::FOR_POLICY_TYPE => self::FOR_POLICY,
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
