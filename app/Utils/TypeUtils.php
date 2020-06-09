<?php

namespace App\Utils;

use Illuminate\Support\Str;

class TypeUtils
{
    public static function getTypeId($name, $types)
    {
        $key = Str::ucfirst(Str::lower($name));
        return array_key_exists($key, $types) ? $types[$key] : '';
    }

    public static function typeMapToRows(array $types): array
    {
        $rows = [];
        foreach ($types as $key => $value) {
            $rows[] = ['id' => $value, 'type' => $key];
        }

        return $rows;
    }
}
