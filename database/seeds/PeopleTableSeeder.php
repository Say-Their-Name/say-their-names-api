<?php

use App\Imports\PersonImporter;
use App\Models\DonationLinks;
use App\Models\Person;
use App\Models\SocialMedia;
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
            factory(SocialMedia::class, rand(1, 5))->create([
                'person_id' => $person->id,
            ]);
        }
    }
}
