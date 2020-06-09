<?php

namespace Tests\Feature;

use App\Models\Person;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class PeopleTest extends TestCase
{
    use RefreshDatabase;

    public function testGetSinglePerson()
    {
        $person = factory(Person::class)->create();

        $response = $this->get('/api/people/' . $person->identifier);

        $response->assertSuccessful();
        $response->assertJsonFragment(['identifier' => $person->identifier]);

        $this->validatePersonJSONStructure($response);
    }

    public function testGetAllPeople()
    {
        $people = factory(Person::class, 6)->create();

        $response = $this->get('/api/people/');

        $response->assertSuccessful();

        $response->assertJsonFragment(['total' => count($people)]);

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

        $response->assertJsonFragment(['message' => 'Not Found']);
    }

    /**
     * Test retrieving getting People filtered by country from the People API.
     *
     * @return void
     */
    public function testGetAllPeopleFilteredByCountry()
    {
        $person = factory(Person::class)->create([
            'country' => 'United Kingdom',
        ]);

        $personNotInArray = factory(Person::class)->create([
            'country' => 'Brazil',
        ]);

        $country = 'United Kingdom';
        $response = $this->get('/api/people?country=' . $person->country . '');

        $response->assertSuccessful();

        $response->assertJsonFragment(['country' => $person->country]);
        $response->assertJsonMissing(['country' => $personNotInArray->country]);

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
        $person = factory(Person::class)->create([
            'city' => 'New York',
        ]);

        $personNotInArray = factory(Person::class)->create([
            'city' => 'Minnesota',
        ]);

        $city = 'London';
        $response = $this->get('/api/people/?city=' . $person->city . '');

        $response->assertSuccessful();

        $response->assertJsonFragment(['city' => $person->city]);
        $response->assertJsonMissing(['city' => $personNotInArray->city]);

        $this->validatePeopleFoundJSONStructure($response);
    }

    /**
     * Test retrieving getting People not found when filtered by country from the People API.
     *
     * @return void
     */
    public function testGetAllPeopleNotFoundFilteredByCity()
    {
        $this->seed();

        $response = $this->get('/api/people/?city=fjdajsfkldajffda');

        $response->assertSuccessful();

        $response->assertJsonFragment(['total' => 0]);

        $this->validatePeopleNotFoundJSONStructure($response);
    }

    /**
     * Test retrieving getting People filtered by country & city from the People API.
     *
     * @return void
     */
    public function testGetAllPeopleFilteredByCountryAndCity()
    {
        $person = factory(Person::class)->create([
            'country' => 'United Kingdom',
            'city' => 'London',
        ]);

        $personNotInArray = factory(Person::class)->create([
            'country' => 'United States',
            'city' => 'New york',
        ]);

        $response = $this->get('/api/people/?country=' . $person->country . '&city=' . $person->city . '');

        $response->assertSuccessful();

        $response->assertJsonFragment(['country' => $person->country]);
        $response->assertJsonFragment(['city' => $person->city]);
        $response->assertJsonMissing(['country' => $personNotInArray->country]);
        $response->assertJsonMissing(['city' => $personNotInArray->city]);

        $this->validatePeopleFoundJSONStructure($response);
    }

    /**
     * Test retrieving getting People filtered by name with an exact match from the People API.
     *
     * @return void
     */
    public function testGetAllPeopleFilteredByNameExactMatch()
    {
        $person = factory(Person::class)->create([
            'full_name' => 'George Floyd',
        ]);

        $personNotInArray = factory(Person::class)->create([
            'full_name' => 'Sandra Bland',
        ]);

        $response = $this->get('/api/people/?name=' . $person->full_name . '');

        $response->assertSuccessful();

        $response->assertJsonFragment(['full_name' => $person->full_name]);
        $response->assertJsonMissing(['full_name' => $personNotInArray->full_name]);

        $this->validatePeopleFoundJSONStructure($response);
    }

    /**
     * Test retrieving getting People filtered by name with a partial match from the People API.
     *
     * @return void
     */
    public function testGetAllPeopleFilteredByNamePartialMatch()
    {
        $person = factory(Person::class)->create([
            'full_name' => 'George Floyd',
        ]);

        $personNotInArray = factory(Person::class)->create([
            'full_name' => 'Sandra Bland',
        ]);

        $response = $this->get('/api/people/?name=Geo');

        $response->assertSuccessful();

        $response->assertJsonFragment(['full_name' => $person->full_name]);
        $response->assertJsonMissing(['full_name' => $personNotInArray->full_name]);

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
     * @param TestResponse $response
     */
    private function validatePersonJSONStructure(TestResponse $response): void
    {
        $response->assertJsonStructure(
            [
                'data' => [
                    'id',
                    'full_name',
                    'identifier',
                    'date_of_incident',
                    'number_of_children',
                    'age',
                    'city',
                    'country',
                    'their_story',
                    'outcome',
                    'context',
                    'images',
                    'donation_links',
                    'petition_links',
                    'media',
                    'hash_tags',
                ],
            ]
        );
    }

    /**
     * @param TestResponse $response
     */
    private function validatePeopleFoundJSONStructure(TestResponse $response): void
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
                        'their_story',
                        'outcome',
                        'context',
                        'images',
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
    private function validatePeopleNotFoundJSONStructure(TestResponse $response): void
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
