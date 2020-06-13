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
            'date_of_incident' => $request->header('x-dates-epoch') ? strtotime($this->date_of_incident) : $this->date_of_incident,
            'number_of_children' => $this->number_of_children == 0 ? null : $this->number_of_children,
            'age' => $this->age,
            'city' => $this->city,
            'country' => $this->country,
            'their_story' => $this->context,
            'outcome' => $this->outcome,
            'biography' => $this->biography,
            'images' => $this->images()->exists() ? $this->images : [
                [
                    'id' => 0,
                    'person_id' => $this->id,
                    'image_url' => 'https://say-their-names.fra1.cdn.digitaloceanspaces.com/assets/cover.png',
                ],
            ],
            'sharable_links' => $this->sharable_links,
            'donation_links' => DonationResource::collection($this->whenLoaded('donationLinks')),
            'petition_links' => PetitionResource::collection($this->whenLoaded('petitionLinks')),
            'media' => $this->images,
            'news' => MediaLinksResource::collection($this->whenLoaded('mediaLinks')),
            'hash_tags' => HashTagResource::collection($this->whenLoaded('hashTags')),
        ];
    }
}
