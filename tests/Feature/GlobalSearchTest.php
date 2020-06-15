<?php

namespace Tests\Feature;

use App\Models\PetitionLink;
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
     * Test retrieving anything from search with invalid input data
     *
     * @return void
     */
    public function testGlobalSearchNoNumbers()
    {
        $response = $this->get('/api/search?query=123');

        $response->assertSuccessful();

        $response->assertJsonFragment(['total' => 0]);


        $this->validateSearchJSONStructure($response);
    }

    /**
     * Test retrieving Donations from Search
     *
     * @return void
     */
    public function testSearchableByFundName()
    {
        $petition = factory(PetitionLink::class)->create([
            'title' => 'Black Lives Matter',
        ]);

        $petitionNotInArray = factory(PetitionLink::class)->create([
            'title' => 'David Dungay Jr',
        ]);

        $response = $this->get('/api/search?query=Black%20Lives');

        $response->assertSuccessful();

        $response->assertJsonFragment(['total' => 0]);

        $this->validateSearchJSONStructure($response);
    }

    /**
     * Test retrieving Petitions by Search
     *
     * @return void
     */
    public function testSearchableByPetitionName()
    {

        $response = $this->get('/api/search?query=Defund%20The');

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

        $response->assertJsonMissing(['full_name' => 'McDade']);


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
