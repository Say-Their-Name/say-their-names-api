<?php

namespace App\Imports;

use App\Models\Person;
use App\Models\Statics\PetitionLinkTypes;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PersonImporter implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        $person = new Person([
            'full_name' => $row['name'],
            'date_of_incident' => $row['date_of_incident'],
            'number_of_children' => $row['number_of_children'],
            'age' => $row['age'],
            'city' => $row['city'],
            'country' => $row['country'],
            'biography' => null,
            'context' => $row['context'],
            'status' => 1,
        ]);

        $person->save();

        foreach (explode(',', $row['images']) as $image) {
            $person->images()->create([
                'image_url' => $image,
                'status' => 1,
            ]);
        }

        foreach (explode(',', $row['news_links']) as $image) {
            $person->mediaLinks()->create([
                'url' => $image,
                'status' => 1,
            ]);
        }

        foreach (explode(',', $row['petition_links']) as $petition) {
            if ($petition == '') {
                continue;
            }
            $person->petitionLinks()->create([
                'title' => "Petition For $person->full_name",
                'description' => "Help bring justice to $person->full_name by signing this petition",
                'link' => $petition,
                'outcome' => null,
                'banner_img_url' => 'https://say-their-names.fra1.cdn.digitaloceanspaces.com/petition.png',
                'outcome_img_url' => 'https://say-their-names.fra1.cdn.digitaloceanspaces.com/petition.png',
                'status' => 1,
                'type_id' => PetitionLinkTypes::FOR_VICTIMS,
            ]);
        }

        return $person;
    }
}
