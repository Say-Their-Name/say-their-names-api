<?php

use App\Models\DonationLink;
use App\Models\MediaLinks;
use App\Models\Person;
use App\Models\PersonImages;
use App\Models\PetitionLink;
use Illuminate\Database\Seeder;

class LocalTableSeeder extends Seeder
{
    public function run()
    {
        $person = factory(Person::class, 15)->create([
            'status' => 1
        ])
            ->each(function ($person) {
                factory(DonationLink::class, 3)->create([
                    'person_id' => $person->id,
                    'status' => 1
                ]);
                factory(PetitionLink::class, 4)->create([
                    'person_id' => $person->id,
                    'status' => 1
                ]);
                factory(PersonImages::class, 3)->create([
                    'person_id' => $person->id,
                    'status' => 1
                ]);
                factory(MediaLinks::class, 3)->create([
                    'person_id' => $person->id,
                    'status' => 1
                ]);
                $person->hashTags()->create([
                    'tag' => '#hashtag',
                    'link' => 'https://twitter.com/search?q=' . urlencode('#hashtag'),
                    'status' => 1
                ]);
            });
    }
}
