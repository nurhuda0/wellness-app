<?php

namespace Tests\Feature;

use App\Models\Partner;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class PartnerDirectoryTest extends TestCase
{
    use DatabaseTransactions;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Create test data once for all tests
        $this->createTestPartners();
    }

    private function createTestPartners()
    {
        // Create a few test partners that can be reused
        Partner::create([
            'name' => 'Test Gym',
            'type' => 'gym',
            'city' => 'Dubai',
            'description' => 'Test gym description',
            'status' => 'active',
        ]);

        Partner::create([
            'name' => 'Test Spa',
            'type' => 'spa',
            'city' => 'Abu Dhabi',
            'description' => 'Test spa description',
            'status' => 'active',
        ]);
    }

    public function test_partners_index_page_loads()
    {
        $response = $this->get('/partners');
        
        $response->assertStatus(200);
        $response->assertSee('Partners Directory');
    }

    public function test_partners_index_shows_partners()
    {
        $response = $this->get('/partners');
        
        $response->assertStatus(200);
        $response->assertSee('Test Gym');
        $response->assertSee('Dubai');
    }

    public function test_partners_filter_by_city()
    {
        $response = $this->get('/partners?city=Dubai');
        
        $response->assertStatus(200);
        $response->assertSee('Test Gym');
        $response->assertDontSee('Test Spa');
    }

    public function test_partners_filter_by_type()
    {
        $response = $this->get('/partners?type=gym');
        
        $response->assertStatus(200);
        $response->assertSee('Test Gym');
        $response->assertDontSee('Test Spa');
    }

    public function test_partners_filter_by_city_and_type()
    {
        // Create additional test data for this specific test
        Partner::create([
            'name' => 'Dubai Spa',
            'type' => 'spa',
            'city' => 'Dubai',
            'description' => 'Dubai spa',
            'status' => 'active',
        ]);

        $response = $this->get('/partners?city=Dubai&type=gym');
        
        $response->assertStatus(200);
        $response->assertSee('Test Gym');
        $response->assertDontSee('Dubai Spa');
    }

    public function test_partner_show_page_loads()
    {
        $partner = Partner::where('name', 'Test Gym')->first();

        $response = $this->get("/partners/{$partner->id}");
        
        $response->assertStatus(200);
        $response->assertSee('Test Gym');
        $response->assertSee('Test gym description');
    }

    public function test_partner_show_page_displays_contact_info()
    {
        $partner = Partner::create([
            'name' => 'Contact Test Partner',
            'type' => 'gym',
            'city' => 'Dubai',
            'description' => 'Test description',
            'address' => 'Test Address',
            'phone' => '+971 123 4567',
            'email' => 'test@partner.ae',
            'website' => 'https://testpartner.ae',
            'status' => 'active',
        ]);

        $response = $this->get("/partners/{$partner->id}");
        
        $response->assertStatus(200);
        $response->assertSee('Test Address');
        $response->assertSee('+971 123 4567');
        $response->assertSee('test@partner.ae');
        $response->assertSee('https://testpartner.ae');
    }

    public function test_partner_show_page_shows_booking_button_for_authenticated_users()
    {
        $user = User::factory()->create();
        $partner = Partner::where('name', 'Test Gym')->first();

        $response = $this->actingAs($user)->get("/partners/{$partner->id}");
        
        $response->assertStatus(200);
        $response->assertSee('Book Session');
    }

    public function test_partner_show_page_shows_sign_in_prompt_for_guests()
    {
        $partner = Partner::where('name', 'Test Gym')->first();

        $response = $this->get("/partners/{$partner->id}");
        
        $response->assertStatus(200);
        $response->assertSee('Sign in to book sessions');
        $response->assertSee('Sign In');
    }

    public function test_only_active_partners_are_shown()
    {
        Partner::create([
            'name' => 'Inactive Partner',
            'type' => 'spa',
            'city' => 'Dubai',
            'description' => 'Inactive partner',
            'status' => 'inactive',
        ]);

        $response = $this->get('/partners');
        
        $response->assertStatus(200);
        $response->assertSee('Test Gym');
        $response->assertDontSee('Inactive Partner');
    }

    public function test_partners_are_paginated()
    {
        // Create exactly 12 more partners (total 14 with setup data)
        for ($i = 1; $i <= 12; $i++) {
            Partner::create([
                'name' => "Partner {$i}",
                'type' => 'gym',
                'city' => 'Dubai',
                'description' => "Partner {$i} description",
                'status' => 'active',
            ]);
        }

        $response = $this->get('/partners');
        
        $response->assertStatus(200);
        $response->assertSee('Showing 1 - 12 of 14 partners');
    }
}
