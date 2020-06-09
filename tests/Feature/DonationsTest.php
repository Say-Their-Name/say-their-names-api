<?php

namespace Tests\Feature;

use App\Models\DonationLink;
use App\Models\Person;
use App\Models\Statics\DonationLinkTypes;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class DonationsTest extends TestCase
{
    use RefreshDatabase;

    public function testGetSingleDonation()
    {
        $donation  = factory(DonationLink::class)->create();

        $response = $this->get("/api/donations/{$donation->identifier}");

        $response->assertSuccessful();

        $response->assertJsonFragment(['identifier' => $donation->identifier]);

        $this->validateDonationJSONStructure($response);
    }

    /**
     * Test retrieving getting all Donations from the Donations API.
     *
     * @return void
     */
    public function testGetAllDonations()
    {
        $donations  = factory(DonationLink::class, 3)->create();

        $response = $this->get('/api/donations/');

        $response->assertSuccessful();

        $response->assertJsonFragment(['total' => count($donations)]);

        $this->validateDonationsFoundJSONStructure($response);
    }

    /**
     * Test retrieving getting Donations filtered by type from the Donations API.
     *
     * @return void
     */
    public function testGetAllDonationsFilteredByType()
    {
        factory(DonationLink::class, 3)->create([
            'type_id' => DonationLinkTypes::VICTIMS,
        ]);

        $type = 'Victims';
        $response = $this->get('/api/donations/?type=' . $type . '');

        $response->assertSuccessful();

        $response->assertJsonFragment(['type' => $type]);
        $response->assertJsonMissing(['type' => 'Movement']);

        $this->validateDonationsFoundJSONStructure($response);
    }

    public function testGetAllDonationsFilteredByPerson()
    {
        $person = factory(Person::class)->create();

        factory(DonationLink::class)->create([
            'person_id' => $person,
        ]);

        $response = $this->get('/api/donations/?name=' . $person->identifier . '');

        $response->assertSuccessful();

        $response->assertJsonFragment(['identifier' => $person->identifier]);
        $response->assertJsonMissing(['identifier' => 'tony-mcdade']);

        $this->validateDonationsFoundJSONStructure($response);
    }

    /**
     * Test retrieving getting Donation filtered by type when found from the Donation API.
     *
     * @return void
     */
    public function testGetAllDonationsNotFoundFilteredByType()
    {
        $response = $this->get('/api/donations/?type=random');

        $response->assertSuccessful();

        $response->assertJsonFragment(['total' => 0]);

        $this->validateDonationsNotFoundJSONStructure($response);
    }

    /**
     * Test retrieving a Single Donation from the Donations API with an invalid ID
     *
     * @return void
     */
    public function testGetSingleDonationNotFound()
    {
        $response = $this->get('/api/donations/908902432');

        $response->assertJsonFragment(['message' => 'Not Found']);
    }

    /**
     * @param TestResponse $response
     */
    private function validateDonationJSONStructure(TestResponse $response): void
    {
        $response->assertJsonStructure(
            [
                'data' => [
                    'id',
                    'identifier',
                    'title',
                    'description',
                    'link',
                    'person',
                ],
            ]
        );
    }

    /**
     * @param TestResponse $response
     */
    private function validateDonationsFoundJSONStructure(TestResponse $response): void
    {
        $response->assertJsonStructure(
            [
                'data' => [
                    [
                        'id',
                        'title',
                        'description',
                        'outcome',
                        'link',
                        'outcome_img_url',
                        'banner_img_url',
                        'sharable_links',
                        'person',
                    ],

                ],
                'links' => [
                    'first',
                    'last',
                    'prev',
                    'next',
                ],
                'meta' => [
                    'current_page',
                    'from',
                    'last_page',
                    'path',
                    'per_page',
                    'to',
                    'total',
                ],
            ]
        );
    }

    /**
     * @param TestResponse $response
     */
    private function validateDonationsNotFoundJSONStructure(TestResponse $response): void
    {
        $response->assertJsonStructure(
            [
                'data' => [],
                'links' => [
                    'first',
                    'last',
                    'prev',
                    'next',
                ],
                'meta' => [
                    'current_page',
                    'from',
                    'last_page',
                    'path',
                    'per_page',
                    'to',
                    'total',
                ],
            ]
        );
    }
}
