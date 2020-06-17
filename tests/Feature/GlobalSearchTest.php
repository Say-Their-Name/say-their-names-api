<?php

namespace Tests\Feature;

use App\Models\DonationLink;
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
     * Test retrieving Donations from Search
     *
     * @return void
     */
    public function testSearchableByPetitionName()
    {
        $petition = factory(PetitionLink::class)->create();

        $response = $this->get("/api/search?query={$petition->title}");

        $response->assertStatus(200);

        $response->assertSuccessful();

        $response->assertJsonFragment(['title' => $petition->title]);

        $this->validateSearchJSONStructure($response);
    }

    /**
     * Test retrieving Petitions by Search
     *
     * @return void
     */
    public function testSearchableByDonationName()
    {

        $donation = factory(DonationLink::class)->create();

        $response = $this->get("/api/search?query={$donation->title}");

        $response->assertStatus(200);

        $response->assertSuccessful();

        $response->assertJsonFragment(['title' => $donation->title]);

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
