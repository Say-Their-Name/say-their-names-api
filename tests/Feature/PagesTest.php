<?php

namespace Tests\Feature;

use Tests\TestCase;

class PagesTest extends TestCase
{
    public function testBasicTest()
    {
        $response = $this->get('/');

        $response->assertStatus(200);        

    }

    public function testPeopleEndPoint()
    {
        $response = $this->get('/api/people/');

        $response->assertStatus(200);

        $this->assertSame('application/json', $response->headers->get('content-type'));

        $this->assertSame('no-cache, private', $response->headers->get('cache-control'));

        $this->assertSame('60', $response->headers->get('x-ratelimit-limit'));
    }

    public function testPetitionsEndPoint()
    {
        $response = $this->get('/api/petitions/');

        $response->assertStatus(200);

    }

    public function testPetitionTypesEndPoint()
    {
        $response = $this->get('/api/petition-types');

        $response->assertStatus(200);

        $this->assertSame('application/json', $response->headers->get('content-type'));

        $this->assertSame('60', $response->headers->get('x-ratelimit-limit'));

    }

    public function testDonationTypesEndPoint()
    {
        $response = $this->get('/api/donation-types');

        $response->assertStatus(200);

        $this->assertSame('application/json', $response->headers->get('content-type'));

        $this->assertSame('60', $response->headers->get('x-ratelimit-limit'));

    }

    public function testDonationsEndPoint()
    {
        $response = $this->get('/api/donations/');

        $response->assertStatus(200);

        $this->assertSame('application/json', $response->headers->get('content-type'));

        $this->assertSame('60', $response->headers->get('x-ratelimit-limit'));

    }

    public function testNotFoundEndpoint()
    {
        $response = $this->get('/fod030u4j3nofw');

        $response->assertNotFound();

        $response->assertStatus(404);
    }
}
