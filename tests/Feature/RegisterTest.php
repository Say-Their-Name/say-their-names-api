<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_registration_returns_a_token()
    {
        // Arrange
        // Prep a request.
        $request = [
            'name'                  => 'Art Blakely',
            'email'                 => 'ablakely@quicktrick.com',
            'password'              => 'pw1234',
            'password_confirmation' => 'pw1234',
            'device_name'           => 'Pixel 4',
        ];
    
        // Act
        // Register.
        $response = $this->postJson('/api/register', $request);
    
        // Assert
        // Ensure we received a token in the response.
        $response->assertSuccessful();
        $this->assertNotNull($response->decodeResponseJson('data.token'));
        $this->assertCount(1, User::all());
    }

    /** @test */
    public function required_fields()
    {
        // Arrange
        // Prep a request w/o any fields.
        $request = [];

        // Act
        // Attempt to register.
        $response = $this->postJson('/api/register', $request);
    
        // Assert
        // Ensure registration failed due in part to missing fields.
        $errors = $response->decodeResponseJson('errors');
        collect(['email', 'password', 'device_name'])
            ->each(function ($field) use ($errors) {
                $this->assertStringContainsString('required', $errors[$field][0]);
            });
        $this->assertCount(0, User::all());
    }

    /** @test */
    public function email_must_be_unique()
    {
        // Arrange
        // Create a user and prep a request to register a user with the same email address.
        $user    = factory(User::class)->create();
        $request = factory(User::class)->raw(['email' => $user->email]);
    
        // Act
        // Attempt to register.
        $response = $this->postJson('/api/register', $request);
    
        // Assert
        // Ensure registration failed due to broken email rules.
        $this->assertEquals(
            'The email has already been taken.',
            $response->decodeResponseJson('errors.email.0')
        );
        $this->assertCount(1, User::all());
    }
    
    /** @test */
    public function email_other_validation()
    {
        // Arrange
        // Prep a request with an email value that breaks all untested rules.
        $email   = str_repeat('a', 256);
        $request = ['email' => $email];
    
        // Act
        // Attempt to register.
        $response = $this->postJson('/api/register', $request);
    
        // Assert
        // Ensure registration failed due to broken email rules.
        $this->assertEquals(
            [
                'The email may not be greater than 255 characters.',
                'The email must be a valid email address.',
            ],
            $response->decodeResponseJson('errors.email')
        );
    }

    /** @test */
    public function password_other_validation()
    {
        // Arrange
        // Prep a reqeuest with a password value that breaks all untested rules.
        $request = ['password' => 'a'];

        // Act
        // Attempt to register.
        $response = $this->postJson('/api/register', $request);

        // Assert
        // Ensure registration failed due to broken email rules.
        $this->assertEquals(
            [
                'The password must be at least 6 characters.',
                'The password confirmation does not match.',
            ],
            $response->decodeResponseJson('errors.password')
        );
    }
}
