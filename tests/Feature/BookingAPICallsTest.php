<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookingAPICallsTest extends TestCase
{
    use RefreshDatabase;

    public function test_nearby_places_api() {
        $response = $this->get('/nearby?lat=3.0069198&lng=101.5363881');
        
        $response->assertJsonStructure();

        $response->assertStatus(200);

        $response->assertSee('property_id');

    }

    public function test_bookings_for_property() {
        
        $property = $this->createProperty();

        $response = $this->get("/properties/{$property->id}/bookings");

        $response->assertJsonStructure();

        $response->assertStatus(200);
    }

    public function test_user_bookings() {
        
        $user = $this->createUser();
        
        $response = $this->get("/users/{$user->id}/bookings");

        $response->assertStatus(200);

        $response->assertSee('bookings');


    }

    
}
