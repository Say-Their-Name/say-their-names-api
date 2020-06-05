<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PersonResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'full_name' => $this->full_name,
            'identifier' => $this->identifier,
            'date_of_birth' => $this->date_of_birth,
            'date_of_incident' => $this->date_of_incident,
            'number_of_children' => $this->number_of_children,
            'age' => $this->age,
            'city' => $this->city,
            'country' => $this->country,
            'their_story' => $this->context,
            'outcome' => $this->outcome,
            'context' => $this->context,
            'images' => $this->images,
            'donation_links' => DonationResource::collection($this->whenLoaded('donationLinks')),
            'petition_links' => PetitionResource::collection($this->whenLoaded('petitionLinks')),
            'media_links' => MediaLinksResource::collection($this->whenLoaded('mediaLinks')),
            'social_media' => SocialMediaResource::collection($this->whenLoaded('socialMedia')),
        ];
    }
}
