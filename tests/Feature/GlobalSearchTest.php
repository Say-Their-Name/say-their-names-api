<?php

namespace Tests\Feature;

use App\Models\Person;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class GlobalSearchTest extends TestCase
{
    use RefreshDatabase;

    public function testGlobalSearchIsWorking()
    {
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
        $person = factory(Person::class)->create();

        $response = $this->get("/api/search?query={$person->full_name}");

        $response->assertSuccessful();

        $response->assertJsonFragment(['full_name' => $person->full_name]);

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
                ],
            ]
        );
    }
}
