<?php

namespace App\Models;

class HashTag extends BaseModel
{
    public function taggable()
    {
        return $this->morphTo();
    }
}
