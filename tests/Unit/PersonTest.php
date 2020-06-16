<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;

use App\Models\Person;


class PersonTest extends TestCase
{
	use RefreshDatabase, WithFaker;
    /**
     * A basic test example.
     *
     * @return void
     */

    public function testPersonHasExpectedColumns()
    {

        $this->assertTrue( 
          Schema::hasColumns('people', [
            'id', 'full_name', 'identifier', 'date_of_incident', 'number_of_children', 'city', 'country', 'context', 'outcome', 'biography', 'sharable_links'
        ]), 1);

    }

}