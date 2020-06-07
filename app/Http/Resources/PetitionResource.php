<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PetitionResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'identifier' => $this->identifier,
            'title' => $this->title,
            'description' => $this->description,
            'outcome' => $this->outcome,
            'link' => $this->link,
            'outcome_img_url' => $this->outcome_img_url,
            'banner_img_url' => $this->banner_img_url,
            'person' => new PersonResource($this->whenLoaded('person')),
            'type' => new PetitionLinkTypesResource($this->whenLoaded('type')),
            'hash_tags' => HashTagResource::collection($this->whenLoaded('hashTags')),
        ];
    }
}
