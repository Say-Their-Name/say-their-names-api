<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class NewsletterTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function newsletter_signup_returns_a_token()
    {
        // Arrange
        // Prep a request.
        $request = [
            'email' => 'ablakely@quicktrick.com',
        ];
    
        // Act
        // Signup.
        $response = $this->postJson('/api/join/newsletter', $request);
    
        // Assert
        // Ensure we received a token in the response.
        $response->assertSuccessful();
        $this->assertNotNull($response->decodeResponseJson('data.token'));
    }

    /** @test */
    public function newsletter_required_field()
    {
        // Arrange
        // Prep a request w/o any fields.
        $request = [];

        // Act
        // Attempt to register.
        $response = $this->postJson('/api/join/newsletter', $request);
    
        // Assert
        // Ensure registration failed due in part to missing fields.
        $errors = $response->decodeResponseJson('errors');
        collect(['email'])
            ->each(function ($field) use ($errors) {
                $this->assertStringContainsString('required', $errors[$field][0]);
            });
        $this->assertCount(0, User::all());
    }

    /** @test */
    public function newsletter_email_must_be_unique()
    {
        // Arrange
        // Create an email and prep a request to register a signup with the same email address.
        $request = (['email' => 'ablakely@quicktrick.com']);
    
        // Act
        // Attempt to signup.
        $response = $this->postJson('/api/join/newsletter', $request);
    
        // Assert
        // Ensure registration failed due to broken email rules.
        $this->assertEquals(
            'You are already a subscriber.',
            $response->decodeResponseJson('errors.email.0')
        );
        $this->assertCount(1, User::all());
    }
    
    /** @test */
    public function newsletter_email_other_validation()
    {
        // Arrange
        // Prep a request with an email value that breaks all untested rules.
        $email   = str_repeat('a', 256);
        $request = ['email' => $email];
    
        // Act
        // Attempt to register.F
        $response = $this->postJson('/api/join/newsletter', $request);
    
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

}