<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MediaLinksResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'url' => $this->url,
        ];
    }
}
