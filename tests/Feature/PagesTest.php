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

    public function testPetitionsEndPoint()
    {
        $response = $this->get('/api/petitions/');

        $response->assertStatus(200);
    }


    public function testPeopleEndPoint()
    {
        $response = $this->get('/api/people/');

        $response->assertStatus(200);
    }

    public function testDonationsEndPoint()
    {
        $response = $this->get('/api/donations/');

        $response->assertStatus(200);
    }

    public function testNotFoundEndpoint()
    {
        $response = $this->get('/fod030u4j3nofw');

        $response->assertNotFound();
    }
}
