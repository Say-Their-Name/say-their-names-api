<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NewsletterTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function newsletter_signup_returns_a_token()
    {
        $response = $this->postJson('/api/join/newsletter', [
            'email' => 'email@email.com',
        ]);

        $response->assertSuccessful();
    }
}
