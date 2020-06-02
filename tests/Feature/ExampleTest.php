<?php

namespace Tests\Feature;

use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * Test 404 for bogus URI.
     *
     * @return void
     */
    public function testBogusURI()
    {
        $response = $this->get('/fod030u4j3nofw');

        $response->assertNotFound();
    }
}
