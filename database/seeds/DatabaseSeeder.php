<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        if (app()->environment('production')) {
            $this->call(PeopleTableSeeder::class);
            $this->call(DonationsTableSeeder::class);
            $this->call(PetitionsTableSeeder::class);
        }

        if (app()->environment('local')) {
            $this->call(LocalTableSeeder::class);
        }
    }
}
