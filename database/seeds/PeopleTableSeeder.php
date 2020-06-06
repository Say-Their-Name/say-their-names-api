<?php

use App\Imports\PersonImporter;
use App\Models\DonationLinks;
use App\Models\HashTag;
use App\Models\Person;
use App\Models\PetitionLinks;
use App\Models\Statics\DonationLinkTypes;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;

class PeopleTableSeeder extends Seeder
{
    public function run()
    {
        Excel::import(new PersonImporter(), storage_path('data/saytheirnames.csv'));
        $people = Person::all();
        foreach ($people as $person) {
            factory(DonationLinks::class)->create([
                'person_id' => $person->id,
                'type_id' => DonationLinkTypes::VICTIMS
            ]);
            $person->hashTags()->saveMany(factory(HashTag::class, rand(1, 9))->make());
        }
        $donations = DonationLinks::all();
        foreach ($donations as $donation) {
            $donation->hashTags()->saveMany(factory(HashTag::class, rand(1, 9))->make());
        }

        $petitions = PetitionLinks::all();
        foreach ($petitions as $petition) {
            $petition->hashTags()->saveMany(factory(HashTag::class, rand(1, 9))->make());
        }
    }
}
