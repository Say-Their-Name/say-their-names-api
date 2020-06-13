<?php

namespace Tests\Feature;

use App\Models\Objects\SharableLinks;
use App\Models\Person;
use Tests\TestCase;

class SharableLinksTest extends TestCase
{
    /** @test */
    public function attributes_cast_to_shareable_links_match_expected_format()
    {
        // Arrange
        // Make a person with sharable links.
        $person = factory(Person::class)->states('withSharableLinks')->make();
    
        // Act
        // Get their sharable links.
        $sharableLinks = $person->sharable_links;
    
        // Assert
        // Ensure the format matches expectations.
        $this->assertEquals(SharableLinks::class, get_class($sharableLinks));
    }

    /** @test */
    public function can_set_sharable_links_value_for_attributes_cast_to_sharable_links()
    {
        // Arrange
        // Make a person without sharable links. Prep some sharable links to set.
        $person = factory(Person::class)->make();
        $sharableLinks = new SharableLinks([
            'base' => 'https://www.saytheirnames.io/profile/madie-howe',
            'facebook' => 'https://www.facebook.com/sharer/sharer.php?u=https://www.saytheirnames.io/profile/madie-howe',
            'twitter' => 'https://twitter.com/home?status=https://www.saytheirnames.io/profile/madie-howe',
            'whatsapp' => 'https://wa.me/?text=https://www.saytheirnames.io/profile/madie-howe',
        ]);
    
        // Act
        // Set the sharable links.
        $person->sharable_links = $sharableLinks;
    
        // Assert
        // Ensure value set.
        $this->assertEquals($sharableLinks, $person->sharable_links);
    }

    /** @test */
    public function cannot_set_non_sharable_links_value_for_attributes_cast_to_sharable_links()
    {
        // Arrange
        // Make a person without sharable links. Prep some sharable links to set.
        $person = factory(Person::class)->make();
        $sharableLinks = [
            'base' => 'https://www.saytheirnames.io/profile/madie-howe',
            'facebook' => 'https://www.facebook.com/sharer/sharer.php?u=https://www.saytheirnames.io/profile/madie-howe',
            'twitter' => 'https://twitter.com/home?status=https://www.saytheirnames.io/profile/madie-howe',
            'whatsapp' => 'https://wa.me/?text=https://www.saytheirnames.io/profile/madie-howe',
        ];
    
        // Act
        // Attempt to set the sharable links.
        try {
            $person->sharable_links = $sharableLinks;
            $result = new \Exception('The attribute erroneously accepted a value not an instance of App\Models\Objects\SharableLinks');
        } catch (\Throwable $th) {
            $result = $th;
        }
    
        // Assert
        // Ensure exception thrown.
        $this->assertEquals('The provided value must be an instance of App\Models\Objects\SharableLinks', $result->getMessage());
    }
}
