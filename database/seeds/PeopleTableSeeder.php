<?php

use App\Models\DonationLinks;
use App\Models\MediaLinks;
use App\Models\Person;
use App\Models\PersonImages;
use App\Models\PetitionLinks;
use App\Models\SocialMedia;
use Illuminate\Database\Seeder;

class PeopleTableSeeder extends Seeder
{
    public function run()
    {
        factory(Person::class, 10)->create()->each(function ($person) {
            $image = factory(PersonImages::class)->create([
                'person_id' => $person->id,
            ]);
            $petition_link = factory(PetitionLinks::class)->create([
                'person_id' => $person->id,
            ]);
            $donation_link = factory(DonationLinks::class)->create([
                'person_id' => $person->id,
            ]);
            $media = factory(MediaLinks::class)->create([
                'person_id' => $person->id,
            ]);
            $social = factory(SocialMedia::class)->create([
                'person_id' => $person->id,
            ]);
            $person->markApproved();
            $image->markApproved();
            $social->markApproved();
            $donation_link->markApproved();
            $petition_link->markApproved();
            $media->markApproved();
        });
    }
}
