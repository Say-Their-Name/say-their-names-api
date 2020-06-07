<?php

namespace App\Imports;

use App\Models\Person;
use App\Models\Statics\DonationLinkTypes;
use App\Models\Statics\PetitionLinkTypes;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PersonImporter implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        $person = $this->createPerson($row);
        $this->createImages($person, $row['images']);
        $this->createNews($person, $row['news_links']);
        $this->createPetitions($person, $row['petition_links']);
        $this->createDonations($person, $row['donation_links']);
        $this->createHashTags($person, $row['hashtags']);
        return $person;
    }

    public function createPerson(array $row)
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
        return $person;
    }

    public function createImages(Person $person, $row)
    {
        foreach (explode(',', $row) as $image) {
            $person->images()->create([
                'image_url' => $image,
                'status' => 1,
            ]);
        }
    }

    public function createNews(Person $person, $row)
    {
        foreach (explode(',', $row) as $image) {
            $person->mediaLinks()->create([
                'url' => $image,
                'status' => 1,
            ]);
        }
    }

    public function createPetitions(Person $person, $row)
    {
        foreach (explode(',', $row) as $petition) {
            if ($petition == '') {
                continue;
            }
            $petitionCreated = $person->petitionLinks()->create([
                'title' => "Petition For $person->full_name",
                'description' => "Help bring justice to $person->full_name by signing this petition",
                'link' => $petition,
                'outcome' => null,
                'banner_img_url' => 'https://say-their-names.fra1.cdn.digitaloceanspaces.com/petition.png',
                'outcome_img_url' => 'https://say-their-names.fra1.cdn.digitaloceanspaces.com/petition.png',
                'status' => 1,
                'type_id' => PetitionLinkTypes::FOR_VICTIMS,
            ]);

            $petitionCreated->hashtags()->create([
                'tag' => '#petitionfor' . str_replace(' ', '', $person->full_name),
                'link' => 'https://twitter.com/search?q=%23petitionfor' . str_replace(' ', '', $person->full_name),
                'status' => 1
            ]);
        }
    }

    public function createDonations(Person $person, $row)
    {
        foreach (explode(',', $row) as $donation) {
            if ($donation == '') {
                continue;
            }
            $donationCreated = $person->donationLinks()->create([
                'title' => "Donate to $person->full_name",
                'description' => "Donate $person->full_name by donating here",
                'link' => $donation,
                'outcome' => null,
                'banner_img_url' => 'https://say-their-names.fra1.cdn.digitaloceanspaces.com/petition.png',
                'outcome_img_url' => 'https://say-their-names.fra1.cdn.digitaloceanspaces.com/petition.png',
                'status' => 1,
                'type_id' => DonationLinkTypes::VICTIMS,
            ]);

            $donationCreated->hashtags()->create([
                'tag' => '#donateto' . str_replace(' ', '', $person->full_name),
                'link' => 'https://twitter.com/search?q=%23donateto' . str_replace(' ', '', $person->full_name),
                'status' => 1
            ]);
        }
    }

    public function createHashTags(Person $person, $row)
    {
        foreach (explode(',', $row) as $hashtag) {
            $person->hashTags()->create([
                'tag' => $hashtag,
                'link' => 'https://twitter.com/search?q=' . urlencode($hashtag),
                'status' => 1
            ]);
        }
    }
}
