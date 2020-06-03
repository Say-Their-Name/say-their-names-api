<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PeopleTest extends TestCase
{
    public function testGetSinglePerson()
    {
        $person_id = '1';
        $response = $this->get('/api/people/' . $person_id . '');

        $response->assertSuccessful();

        $response->assertJsonFragment(['person_id' => $person_id]);
        $response->assertJsonFragment(['full_name' => 'George Floyd']);

        $this->validatePersonJSONStructure($response);
    }

    /**
     * Test retrieving getting all People from the People API.
     *
     * @return void
     */
    public function testGetAllPeople()
    {
        $response = $this->get('/api/people/');

        $response->assertSuccessful();

        $this->validatePeopleFoundJSONStructure($response);
    }

    /**
     * Test retrieving a Single Person from the People API with an invalid ID
     *
     * @return void
     */
    public function testGetSinglePersonNotFound()
    {
        $response = $this->get('/api/people/343432432432');

        $response->assertStatus(500);
    }

    /**
     * Test retrieving getting People filtered by country from the People API.
     *
     * @return void
     */
    public function testGetAllPeopleFilteredByCountry()
    {
        $country = 'United Kingdom';
        $response = $this->get('/api/people?country=' . $country . '');

        $response->assertSuccessful();

        $response->assertJsonFragment(['country' => $country]);
        $response->assertJsonMissing(['country' => 'United States']);

        $this->validatePeopleFoundJSONStructure($response);
    }

    /**
     * Test retrieving getting People not found when filtered by country from the People API.
     *
     * @return void
     */
    public function testGetAllPeopleNotFoundFilteredByCountry()
    {
        $response = $this->get('/api/people/?country=fjdajsfkldajffda');

        $response->assertSuccessful();

        $response->assertJsonFragment(['total' => 0]);

        $this->validatePeopleNotFoundJSONStructure($response);
    }


    /**
     * Test retrieving getting People filtered by city from the People API.
     *
     * @return void
     */
    public function testGetAllPeopleFilteredByCity()
    {
        $city = 'London';
        $response = $this->get('/api/people/?city=' . $city . '');

        $response->assertSuccessful();

        $response->assertJsonFragment(['city' => $city]);
        $response->assertJsonMissing(['city' => 'Minnesota']);

        $this->validatePeopleFoundJSONStructure($response);
    }

    /**
     * Test retrieving getting People not found when filtered by country from the People API.
     *
     * @return void
     */
    public function testGetAllPeopleNotFoundFilteredByCity()
    {
        $response = $this->get('/api/people/?city=fjdajsfkldajffda');

        $response->assertSuccessful();

        $response->assertJsonFragment(['total' => 0]);

        $this->validatePeopleNotFoundJSONStructure($response);
    }

    /**
     * Test retrieving getting People filtered by name with an exact match from the People API.
     *
     * @return void
     */
    public function testGetAllPeopleFilteredByNameExactMatch()
    {
        $name = 'Sandra Bland';
        $response = $this->get('/api/people/?name=' . $name . '');

        $response->assertSuccessful();

        $response->assertJsonFragment(['full_name' => $name]);
        $response->assertJsonMissing(['full_name' => 'George Floyd']);

        $this->validatePeopleFoundJSONStructure($response);
    }

    /**
     * Test retrieving getting People filtered by name with a partial match from the People API.
     *
     * @return void
     */
    public function testGetAllPeopleFilteredByNamePartialMatch()
    {
        $response = $this->get('/api/people/?name=Sa');

        $response->assertSuccessful();

        $response->assertJsonFragment(['full_name' => 'Sandra Bland']);
        $response->assertJsonFragment(['full_name' => 'Sarah Reed']);
        $response->assertJsonMissing(['full_name' => 'Trayvon Martin']);

        $this->validatePeopleFoundJSONStructure($response);
    }

    /**
     * Test retrieving getting People filtered by name that's not found from the People API.
     *
     * @return void
     */
    public function testGetAllPeopleNotFoundFilteredByName()
    {
        $response = $this->get('/api/people/?name=34309090dfasXXerw');

        $response->assertSuccessful();

        $response->assertJsonFragment(['total' => 0]);

        $this->validatePeopleNotFoundJSONStructure($response);
    }

    /**
     * @param \Illuminate\Testing\TestResponse $response
     */
    private function validatePersonJSONStructure(\Illuminate\Testing\TestResponse $response): void
    {
        $response->assertJsonStructure(
            [
                'data' => [
                    'id',
                    'full_name',
                    'date_of_incident',
                    'number_of_children',
                    'age',
                    'city',
                    'country',
                    'biography',
                    'context',
                    'images',
                    'donation_links',
                    'petition_links',
                    'media_links',
                    'social_media'
                ]
            ]
        );
    }

    /**
     * @param \Illuminate\Testing\TestResponse $response
     */
    private function validatePeopleFoundJSONStructure(\Illuminate\Testing\TestResponse $response): void
    {
        $response->assertJsonStructure(
            [
                'data' => [
                    [
                        'id',
                        'full_name',
                        'date_of_incident',
                        'number_of_children',
                        'age',
                        'city',
                        'country',
                        'biography',
                        'context',
                        'images'
                    ]
                ],
                'links' => [
                    'first',
                    'last',
                    'prev',
                    'next'
                ],
                'meta' => [
                    'current_page',
                    'from',
                    'last_page',
                    'path',
                    'per_page',
                    'to',
                    'total'
                ]
            ]
        );
    }

    /**
     * @param \Illuminate\Testing\TestResponse $response
     */
    private function validatePeopleNotFoundJSONStructure(\Illuminate\Testing\TestResponse $response): void
    {
        $response->assertJsonStructure(
            [
                'data' => [],
                'links' => [
                    'first',
                    'last',
                    'prev',
                    'next'
                ],
                'meta' => [
                    'current_page',
                    'from',
                    'last_page',
                    'path',
                    'per_page',
                    'to',
                    'total'
                ]
            ]
        );
    }
}
