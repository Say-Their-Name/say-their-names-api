<?php

use App\Models\Person;
use App\Models\Statics\DonationLinkTypes;
use App\Models\Statics\PetitionLinkTypes;
use Illuminate\Database\Seeder;
use Tapp\Airtable\Facades\AirtableFacade as Airtable;

class PeopleTableSeeder extends Seeder
{
    public function run()
    {
        $airtablePeople = Airtable::table('victims')->all();

        foreach ($airtablePeople as $people) {
            if (isset($people['fields']['APPROVED']) && $people['fields']['APPROVED'] == 'true') {
                $person = $this->createPerson($people['fields']);
                if (isset($people['fields']['IMAGES'])) {
                    $this->createImages($person, $people['fields']['IMAGES']);
                }
                if (isset($people['fields']['NEWS LINKS'])) {
                    $this->createNews($person, $people['fields']['NEWS LINKS']);
                }
                if (isset($people['fields']['PETITION LINKS'])) {
                    $this->createPetitions($person, $people['fields']['PETITION LINKS']);
                }
                if (isset($people['fields']['DONATION LINKS'])) {
                    $this->createDonations($person, $people['fields']['DONATION LINKS']);
                }
                $this->createHashTags($person, $people['fields']['HASHTAGS']);
            } else {
                continue;
            }
        }
    }

    public function createPerson(array $row)
    {
        $person = Person::updateOrCreate(
            ['full_name' => isset($row['NAME']) ? $row['NAME'] : null],
            [
                'date_of_incident' => isset($row['DATE OF INCIDENT']) ? $row['DATE OF INCIDENT'] : null,
                'number_of_children' => isset($row['NUMBER OF CHILDREN']) ? $row['NUMBER OF CHILDREN'] : null,
                'age' => isset($row['AGE']) ? $row['AGE'] : null,
                'city' => isset($row['CITY']) ? $row['CITY'] : null,
                'country' => isset($row['COUNTRY']) ? $row['COUNTRY'] : null,
                'context' => isset($row['CONTEXT']) ? str_replace("\n\\n", '', $row['CONTEXT']) : null,
                'outcome' => isset($row['OUTCOME']) ? str_replace("\n\\n", '', $row['OUTCOME']) : null,
                'biography' => isset($row['BIOGRAPHY']) ? str_replace("\n\\n", '', $row['BIOGRAPHY']) : null,
                'status' => 1,
            ]
        );
        $person->save();
        return $person;
    }

    public function createImages(Person $person, $row)
    {
        foreach (explode(',', $row) as $image) {
            $person->images()->updateOrCreate(
                ['image_url' => $image],
                [
                    'status' => 1,
                ]
            );
        }
    }

    public function createNews(Person $person, $row)
    {
        foreach (explode(',', $row) as $image) {
            $person->mediaLinks()->updateOrCreate(
                ['url' => str_replace(' ', '', $image)],
                [
                    'status' => 1,
                ]
            );
        }
    }

    public function createPetitions(Person $person, $row)
    {
        foreach (explode(',', $row) as $petition) {
            if ($petition == '') {
                continue;
            }
            $petitionCreated = $person->petitionLinks()->updateOrCreate(
                ['link' => str_replace(' ', '', $petition)],
                [
                    'title' => "Petition For {$person->full_name}",
                    'description' => "Help bring justice to {$person->full_name} by signing this petition",
                    'link' => $petition,
                    'outcome' => null,
                    'banner_img_url' => 'https://saytheirnames.dev/images/assets/petition_banner.jpg',
                    'outcome_img_url' => 'https://saytheirnames.dev/images/assets/petition_banner.jpg',
                    'status' => 1,
                    'type_id' => PetitionLinkTypes::FOR_VICTIMS,
                ]
            );

            $petitionCreated->hashtags()->updateOrCreate(
                ['link' => 'https://twitter.com/search?q=%23petitionfor' . str_replace(' ', '', $person->full_name)],
                [
                    'tag' => '#petitionfor' . str_replace(' ', '', $person->full_name),
                    'link' => 'https://twitter.com/search?q=%23petitionfor' . str_replace(' ', '', $person->full_name),
                    'status' => 1,
                ]
            );
        }
    }

    public function createDonations(Person $person, $row)
    {
        foreach (explode(',', $row) as $donation) {
            if ($donation == '') {
                continue;
            }
            $donationCreated = $person->donationLinks()->updateOrCreate(
                ['link' => str_replace(' ', '', $donation)],
                [
                    'title' => "Donate to the {$person->full_name} Memorial Fund",
                    'description' => "Support the fight for justice for {$person->full_name} by donating to their family's memorial fund.",
                    'link' => $donation,
                    'outcome' => null,
                    'banner_img_url' => 'https://saytheirnames.dev/images/assets/petition_banner.jpg',
                    'outcome_img_url' => 'https://saytheirnames.dev/images/assets/petition_banner.jpg',
                    'status' => 1,
                    'type_id' => DonationLinkTypes::VICTIMS,
                ]
            );

            $donationCreated->hashtags()->updateOrCreate(
                ['link' => 'https://twitter.com/search?q=%23donateto' . str_replace(' ', '', $person->full_name)],
                [
                    'tag' => '#donateto' . str_replace(' ', '', $person->full_name),
                    'link' => 'https://twitter.com/search?q=%23donateto' . str_replace(' ', '', $person->full_name),
                    'status' => 1,
                ]
            );
        }
    }

    public function createHashTags(Person $person, $row)
    {
        foreach (explode(',', $row) as $hashtag) {
            $person->hashTags()->updateOrCreate(
                ['link' => 'https://twitter.com/search?q=' . urlencode($hashtag)],
                [
                    'tag' => $hashtag,
                    'link' => 'https://twitter.com/search?q=' . urlencode($hashtag),
                    'status' => 1,
                ]
            );
        }
    }
}
