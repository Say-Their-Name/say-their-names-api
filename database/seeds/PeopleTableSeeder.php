<?php

use App\Imports\DonationLinkImporter;
use App\Imports\PersonImporter;
use App\Imports\PetitionLinkImporter;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;

class PeopleTableSeeder extends Seeder
{
    public function run()
    {
        Excel::import(new PetitionLinkImporter(), storage_path('data/petitions.csv'));
        Excel::import(new DonationLinkImporter(), storage_path('data/donations.csv'));
        Excel::import(new PersonImporter(), storage_path('data/saytheirnames.csv'));
    }
}
