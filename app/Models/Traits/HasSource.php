<?php

namespace App\Models\Traits;

use App\Models\Statics\Source;

trait HasSource
{
    public function source()
    {
        return $this->belongsTo(Source::class);
    }
}
