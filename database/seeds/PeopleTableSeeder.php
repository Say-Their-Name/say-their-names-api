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
    }
}
