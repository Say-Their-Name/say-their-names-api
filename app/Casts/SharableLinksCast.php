<?php

namespace App\Casts;

use App\Models\Objects\SharableLinks;
use Exception;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class SharableLinksCast implements CastsAttributes
{
    public function get($model, $key, $value, $attributes)
    {
        if (! $value) {
            return null;
        }

        return new SharableLinks(json_decode($value, true));
    }

    public function set($model, $key, $value, $attributes)
    {
        if (! $value instanceof SharableLinks) {
            throw new Exception("The provided value must be an instance of " . SharableLinks::class);
        }
        return json_encode($value->toArray());
    }
}
