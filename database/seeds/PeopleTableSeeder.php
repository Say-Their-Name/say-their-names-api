<?php

use App\Models\DonationLinks;
use App\Models\MediaLinks;
use App\Models\Person;
use App\Models\PersonImages;
use App\Models\PetitionLinks;
use App\Models\SocialMedia;
use App\Models\Statics\Source;
use Illuminate\Database\Seeder;

class PeopleTableSeeder extends Seeder
{
    public function run()
    {
        factory(Person::class, 10)->create()->each(function ($person) {
            factory(PersonImages::class, 3)->create([
                'person_id' => $person->id,
            ]);
            factory(PetitionLinks::class)->create([
                'person_id' => $person->id,
            ]);
            factory(DonationLinks::class)->create([
                'person_id' => $person->id,
            ]);
            factory(MediaLinks::class, 6)->create([
                'person_id' => $person->id,
            ]);
            factory(SocialMedia::class)->create([
                'person_id' => $person->id,
            ]);
            $person->markApproved();
        });
    }
}
