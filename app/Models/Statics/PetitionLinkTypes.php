<?php

namespace App\Models\Statics;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;
use Sushi\Sushi;

class PetitionLinkTypes extends Model
{
    use Sushi;
    use Filterable;

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

    public static function fromName($name)
    {
        $linkType = null;

        switch (strtoupper($name)) {
            case "VICTIMS":
                $linkType = PetitionLinkTypes::FOR_VICTIMS;
                break;
            case "POLICY":
                $linkType = PetitionLinkTypes::FOR_POLICY;
                break;
            default:
                $linkType = "";
        }

        return $linkType;
    }
}
