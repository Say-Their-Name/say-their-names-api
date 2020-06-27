<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Arr;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function testUserWithCorrectCredentialsCanLogIn()
    {
        $user = factory(User::class)->create(['password' => bcrypt('pw1234')]);
        $user->createToken('Pixel 4');

        $response = $this->postJson('/api/login', [
            'device_name' => 'Pixel 4',
            'email'       => $user->email,
            'password'    => 'pw1234',
        ]);

        $response->assertSuccessful();
        $this->assertNotNull($response->decodeResponseJson('data.token'));
    }

    public function testUserWithIncorrectCredentialsCannotLogIn()
    {
        $user = factory(User::class)->create(['password' => bcrypt('pw1234')]);
        $user->createToken('Pixel 4');
        $data = [
            'device_name' => 'Pixel 4',
            'email'       => $user->email,
            'password'    => "I don't know the password.",
        ];

        $response = $this->postJson('/api/login', $data);

        $responseData = $response->decodeResponseJson();
        $response->assertStatus(422);
        $this->assertEquals('The given data was invalid.', $responseData['message']);
        $this->assertEquals('The provided credentials are incorrect.', Arr::get($responseData, 'errors.email.0'));
    }
}
