<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookmarksTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('bookmarks')->insert(['user_id' => 1, 'person_id' => 1]);
        DB::table('bookmarks')->insert(['user_id' => 1, 'person_id' => 2]);
    }
}
