<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SocialMediaResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'title' => $this->title,
            'type' => $this->type,
            'link' => $this->link,
        ];
    }
}
