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

    public function testBogusURI()
    {
        $response = $this->get('/fod030u4j3nofw');

        $response->assertNotFound();
    }
}
