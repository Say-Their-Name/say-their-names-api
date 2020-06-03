<?php

namespace Tests\Feature;

use Tests\TestCase;

class PeopleTest extends TestCase
{
    public function testGetSinglePerson()
    {
        $response = $this->get('/api/people/1');

        $response->assertSuccessful();

        $response->assertJsonFragment(['person_id' => "1"]);
        $response->assertJsonFragment(['full_name' => "George Floyd"]);

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

    public function testGetAllPeople()
    {
        $response = $this->get('/api/people/');

        $response->assertSuccessful();

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

    public function testGetSinglePersonNotFound()
    {
        $response = $this->get('/api/people/343432432432');

        $response->assertStatus(500);
    }
}
