<?php

namespace App\Models\Statics;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Sushi\Sushi;

class PetitionLinkTypes extends Model
{
    use Sushi;
    use Filterable;

    const FOR_VICTIMS = 1;
    const FOR_VICTIM_TYPE = 'Victims';
    const FOR_POLICY = 2;
    const FOR_POLICY_TYPE = 'Policy';

    protected $rows = [
        [
            'id' => self::FOR_VICTIMS,
            'type' => self::FOR_VICTIM_TYPE,
        ],
        [
            'id' => self::FOR_POLICY,
            'type' => self::FOR_POLICY_TYPE,
        ],
    ];

    public static function fromName($name)
    {
        $linkType = null;

        switch (strtoupper($name)) {
            case Str::upper(self::FOR_VICTIM_TYPE):
                $linkType = PetitionLinkTypes::FOR_VICTIMS;
                break;
            case Str::upper(self::FOR_POLICY_TYPE):
                $linkType = PetitionLinkTypes::FOR_POLICY;
                break;
            default:
                $linkType = "";
        }
        return $linkType;
    }
}
