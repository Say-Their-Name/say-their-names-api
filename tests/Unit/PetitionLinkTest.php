<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;

use Tests\TestCase;


class PetitionLink extends TestCase
{
	use RefreshDatabase, WithFaker;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testPetitionLinkHasExpectedColumns()
    {
        $this->assertTrue( 
          Schema::hasColumns('petition_links', [
            'person_id', 'type_id', 'identifier', 'banner_img_url', 'title', 'description','outcome',  'outcome_img_url', 'link', 'sharable_links', 'person_id', 'status', 'moderated_at', 'moderated_by'
        ]), 1);
    }
}
