<?php

use App\Imports\PersonImporter;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;

class PeopleTableSeeder extends Seeder
{
    public function run()
    {
        Excel::import(new PersonImporter(), storage_path('data/saytheirnames.csv'));
    }
}
