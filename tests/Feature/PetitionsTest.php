<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class PetitionsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test retrieving a Single Petition from the Petitions API.
     *
     * @return void
     */
    public function testGetSinglePetition()
    {
        $this->seed();

        $petition_id = 1;
        $response = $this->get('/api/petitions/' . $petition_id . '');

        $response->assertSuccessful();

        $response->assertJsonFragment(['id' => $petition_id]);

        $this->validatePetitionJSONStructure($response);
    }

    /**
     * Test retrieving getting all Petitions from the Petitions API.
     *
     * @return void
     */
    public function testGetAllPetitions()
    {
        $this->seed();

        $response = $this->get('/api/petitions/');

        $response->assertSuccessful();

        $this->validatePetitionsFoundJSONStructure($response);
    }

    /**
     * Test retrieving getting Petitions filtered by type from the Donations API.
     *
     * @return void
     */
    public function testGetAllPetitionsFilteredByType()
    {
        $this->seed();

        $type = 'Victims';
        $response = $this->get('/api/petitions/?type=' . $type . '');

        $response->assertSuccessful();

        $response->assertJsonFragment(['type' => $type]);
        $response->assertJsonMissing(['type' => 'Policy']);

        $this->validatePetitionsFoundJSONStructure($response);
    }

    /**
     * Test retrieving getting Petitions filtered by type when found from the Donation API.
     *
     * @return void
     */
    public function testGetAllPetitionsNotFoundFilteredByName()
    {
        $response = $this->get('/api/petitions/?type=random');

        $response->assertSuccessful();

        $response->assertJsonFragment(['total' => 0]);

        $this->validatePetitionsNotFoundJSONStructure($response);
    }

    /**
     * Test retrieving a Single Petition from the Petitions API with an invalid ID
     *
     * @return void
     */
    public function testGetSinglePetitionNotFound()
    {
        $response = $this->get('/api/petitions/343432432432');

        $response->assertJsonFragment(['message' => "Not Found"]);
    }

    /**
     * @param TestResponse $response
     */
    private function validatePetitionJSONStructure(TestResponse $response): void
    {
        $response->assertJsonStructure(
            [
                'data' => [
                    'id',
                    'title',
                    'description',
                    'link',
                    'person'
                ]
            ]
        );
    }

    /**
     * @param TestResponse $response
     */
    private function validatePetitionsFoundJSONStructure(TestResponse $response): void
    {
        $response->assertJsonStructure(
            [
                'data' => [
                    [
                        'id',
                        'title',
                        'description',
                        'link',
                        'person'
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
     * @param TestResponse $response
     */
    private function validatePetitionsNotFoundJSONStructure(TestResponse $response): void
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
