<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class GlobalSearchTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test performing a global search on the API.
     *
     * @return void
     */
    public function testGlobalSearchIsWorking()
    {
        $this->seed();
        $response = $this->get('/api/search?query=test');

        $response->assertSuccessful();
        $this->validateSearchJSONStructure($response);
    }

    /**
     * Test search API returns correct results.
     *
     * @return void
     */
    public function testSearchResultsAreAccurate()
    {
        $this->seed();
        $name = 'George Floyd';
        $response = $this->get("/api/search?query=$name");

        $response->assertSuccessful();

        $response->assertJsonFragment(['full_name' => $name]);
        $response->assertJsonMissing(['full_name' => 'Tony']);

        $this->validateSearchJSONStructure($response);
    }

    /**
     * @param TestResponse $response
     */
    private function validateSearchJSONStructure(TestResponse $response): void
    {
        $response->assertJsonStructure(
            [
                'data' => [
                    'results' => [],
                ]
            ]
        );
    }
}
