<?php

namespace Tests\Feature;

use App\Models\Property;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PropertyDescriptionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_generates_property_description()
    {
        $response = $this->post('/property-description', [
            'title' => 'Beautiful Family House',
            'property_type' => 'House',
            'location' => 'Lagos, Nigeria',
            'price' => 5000000,
            'key_features' => 'Spacious living room, modern kitchen, large backyard',
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('properties', [
            'title' => 'Beautiful Family House',
            'location' => 'Lagos, Nigeria',
            'price' => 5000000,
        ]);

        $this->assertNotEmpty($response->getContent());
    }

    /** @test */
    public function it_validates_required_fields()
    {
        $response = $this->post('/property-description', []);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['title', 'property_type', 'location', 'price', 'key_features']);
    }

    /** @test */
    public function it_can_regenerate_description()
    {
        $property = Property::create([
            'title' => 'Cozy Apartment',
            'property_type' => 'Flat',
            'location' => 'Abuja, Nigeria',
            'price' => 3000000,
            'key_features' => '2 bedrooms, close to public transport',
        ]);

        $response = $this->post('/property-description/regenerate', [
            'property_id' => $property->id,
        ]);

        $response->assertStatus(200);
        $this->assertNotEmpty($response->getContent());
    }
}