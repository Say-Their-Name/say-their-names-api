<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
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
     * @param \Illuminate\Testing\TestResponse $response
     */
    private function validateDonationJSONStructure(\Illuminate\Testing\TestResponse $response): void
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
    private function validateDonationsFoundJSONStructure(\Illuminate\Testing\TestResponse $response): void
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
