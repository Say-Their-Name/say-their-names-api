<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DonationResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'outcome' => $this->outcome,
            'link' => $this->link,
            'image_url' => $this->image_url,
            'person' => new PersonResource($this->whenLoaded('person')),
            'type' => new DonationLinkTypesResource($this->whenLoaded('type')),
        ];
    }
}
