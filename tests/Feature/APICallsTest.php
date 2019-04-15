<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class APICallsTest extends TestCase
{
    public function test_nearby_places_api() {
        $response = $this->get('/nearby?lat=3.0069198&lng=101.5363881');
        
        $response->assertJsonStructure();

        $response->assertStatus(200);

        $response->assertSee('property_id');

    }

    public function test_bookings_for_property() {
        
        $response = $this->get('/properties/1/bookings');

        $response->assertJsonStructure();

        $response->assertStatus(200);
    }

    public function test_user_bookings() {
        
        $response = $this->get('/users/1/bookings');

        $response->assertStatus(200);

        $response->assertSee('bookings');


    }

    
}
