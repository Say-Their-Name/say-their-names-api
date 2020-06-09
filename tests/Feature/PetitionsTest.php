<?php

namespace Tests\Feature;

use App\Models\Person;
use App\Models\PetitionLink;
use App\Models\Statics\PetitionLinkTypes;
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
        $petition = factory(PetitionLink::class)->create();

        $response = $this->get("/api/petitions/$petition->identifier");

        $response->assertSuccessful();

        $response->assertJsonFragment(['identifier' => $petition->identifier]);

        $this->validatePetitionJSONStructure($response);
    }

    /**
     * Test retrieving getting all Petitions from the Petitions API.
     *
     * @return void
     */
    public function testGetAllPetitions()
    {
        $petitions = factory(PetitionLink::class, 9)->create();

        $response = $this->get('/api/petitions/');

        $response->assertSuccessful();

        $response->assertJsonFragment(['total' => count($petitions)]);

        $this->validatePetitionsFoundJSONStructure($response);
    }

    /**
     * Test retrieving getting Petitions filtered by type from the Donations API.
     *
     * @return void
     */
    public function testGetAllPetitionsFilteredByType()
    {

        factory(PetitionLink::class, 9)->create([
            'type_id' => PetitionLinkTypes::FOR_POLICY,
        ]);

        $response = $this->get('/api/petitions/?type=' . PetitionLinkTypes::FOR_POLICY_TYPE . '');

        $response->assertSuccessful();

        $response->assertJsonFragment(['type' => PetitionLinkTypes::FOR_POLICY_TYPE]);
        $response->assertJsonMissing(['type' => PetitionLinkTypes::FOR_VICTIM_TYPE]);

        $this->validatePetitionsFoundJSONStructure($response);
    }

    /**
     * Test retrieving getting Petitions filtered by type when found from the Petition API.
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

    public function testGetAllPetitionsFilteredByName()
    {
        $person = factory(Person::class)->create([
            'full_name' => 'George Floyd'
        ]);

        factory(PetitionLink::class)->create([
            'person_id' => $person->id,
        ]);

        $personNotInArray = factory(Person::class)->create([
            'full_name' => 'Sandra Bland'
        ]);

        $response = $this->get('/api/petitions/?name=' . $person->indentifier . '');

        $response->assertSuccessful();

        $response->assertJsonFragment(['identifier' => $person->identifier]);
        $response->assertJsonMissing(['identifier' => $personNotInArray->identifier]);

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
