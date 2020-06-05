<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class DonationsTest extends TestCase
{
    use RefreshDatabase;

    public function testGetSingleDonation()
    {
        $this->seed();
        $donation_id = 2;
        $response = $this->get('/api/donations/' . $donation_id . '');

        $response->assertSuccessful();

        $response->assertJsonFragment(['id' => $donation_id]);

        $this->validateDonationJSONStructure($response);
    }

    /**
     * Test retrieving getting all Donations from the Donations API.
     *
     * @return void
     */
    public function testGetAllDonations()
    {
        $this->seed();
        $response = $this->get('/api/donations/');

        $response->assertSuccessful();

        $this->validateDonationsFoundJSONStructure($response);
    }

    /**
     * Test retrieving getting Donations filtered by type from the Donations API.
     *
     * @return void
     */
    public function testGetAllDonationsFilteredByType()
    {
        $this->seed();

        $type = 'Victims';
        $response = $this->get('/api/donations/?type=' . $type . '');

        $response->assertSuccessful();

        $response->assertJsonFragment(['type' => $type]);
        $response->assertJsonMissing(['type' => 'Movement']);

        $this->validateDonationsFoundJSONStructure($response);
    }

    public function testGetAllDonationsFilteredByPerson()
    {
        $this->seed();

        $name = 'george-floyd';
        $response = $this->get('/api/donations/?name=' . $name . '');

        $response->assertSuccessful();

        $response->assertJsonFragment(['identifier' => $name]);
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

        $response->assertJsonFragment(['message' => "Not Found"]);
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
    private function validateDonationsFoundJSONStructure(TestResponse $response): void
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
    private function validateDonationsNotFoundJSONStructure(TestResponse $response): void
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
