<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class HashTagResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'tag' => $this->tag,
            'link' => $this->link,
        ];
    }
}
