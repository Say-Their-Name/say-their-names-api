<?php

namespace Tests\Feature;

use Tests\TestCase;

class PetitionsTest extends TestCase
{
    /**
     * Test retrieving a Single Petition from the Petitions API.
     *
     * @return void
     */
    public function testGetSinglePetition()
    {
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
        $response = $this->get('/api/petitions/');

        $response->assertSuccessful();

        $this->validatePetitionsFoundJSONStructure($response);
    }

    /**
     * Test retrieving a Single Petition from the Petitions API with an invalid ID
     *
     * @return void
     */
    public function testGetSinglePetitionNotFound()
    {
        $response = $this->get('/api/petitions/343432432432');

        $response->assertStatus(500);
    }

    /**
     * @param \Illuminate\Testing\TestResponse $response
     */
    private function validatePetitionJSONStructure(\Illuminate\Testing\TestResponse $response): void
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
     * @param \Illuminate\Testing\TestResponse $response
     */
    private function validatePetitionsFoundJSONStructure(\Illuminate\Testing\TestResponse $response): void
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
}
