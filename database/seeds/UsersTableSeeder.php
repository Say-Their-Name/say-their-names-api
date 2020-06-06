<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        factory(User::class)->create([
            'name' => 'Test User',
            'email' => 'test-user@test.com',
        ]);
    }
}
