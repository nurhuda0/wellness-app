<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Booking;
use App\Models\Partner;
use App\Models\Company;
use App\Models\Membership;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;

class AdminPanelTest extends TestCase
{
    use DatabaseTransactions, WithFaker;

    protected $admin;
    protected $user;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Create admin user
        $this->admin = User::factory()->create([
            'role' => 'super_admin',
            'email' => 'admin@test.com',
            'password' => bcrypt('password'),
        ]);

        // Create regular user
        $this->user = User::factory()->create([
            'role' => 'user',
            'email' => 'user@test.com',
            'password' => bcrypt('password'),
        ]);
    }

    /** @test */
    public function admin_can_access_dashboard()
    {
        $response = $this->actingAs($this->admin)
            ->get(route('admin.dashboard'));

        $response->assertStatus(200);
        $response->assertSee('Admin Dashboard');
        $response->assertSee('System Health');
        $response->assertSee('Key Metrics');
    }

    /** @test */
    public function non_admin_cannot_access_dashboard()
    {
        $response = $this->actingAs($this->user)
            ->get(route('admin.dashboard'));

        $response->assertStatus(403);
    }

    /** @test */
    public function admin_can_view_users_page()
    {
        $response = $this->actingAs($this->admin)
            ->get(route('admin.users'));

        $response->assertStatus(200);
        $response->assertSee('User Management');
        $response->assertSee($this->user->name);
        $response->assertSee($this->admin->name);
    }

    /** @test */
    public function admin_can_search_users()
    {
        $response = $this->actingAs($this->admin)
            ->get(route('admin.users', ['search' => $this->user->name]));

        $response->assertStatus(200);
        $response->assertSee($this->user->name);
        $response->assertDontSee($this->admin->name);
    }

    /** @test */
    public function admin_can_filter_users_by_role()
    {
        $response = $this->actingAs($this->admin)
            ->get(route('admin.users', ['role' => 'user']));

        $response->assertStatus(200);
        $response->assertSee($this->user->name);
        $response->assertDontSee($this->admin->name);
    }

    /** @test */
    public function admin_can_view_bookings_page()
    {
        // Create a booking
        $partner = Partner::factory()->create();
        $booking = Booking::factory()->create([
            'user_id' => $this->user->id,
            'partner_id' => $partner->id,
        ]);

        $response = $this->actingAs($this->admin)
            ->get(route('admin.bookings'));

        $response->assertStatus(200);
        $response->assertSee('Booking Management');
        $response->assertSee($this->user->name);
        $response->assertSee($partner->name);
    }

    /** @test */
    public function admin_can_search_bookings()
    {
        $partner = Partner::factory()->create();
        $booking = Booking::factory()->create([
            'user_id' => $this->user->id,
            'partner_id' => $partner->id,
        ]);

        $response = $this->actingAs($this->admin)
            ->get(route('admin.bookings', ['search' => $this->user->name]));

        $response->assertStatus(200);
        $response->assertSee($this->user->name);
    }

    /** @test */
    public function admin_can_filter_bookings_by_status()
    {
        $partner = Partner::factory()->create();
        $booking = Booking::factory()->create([
            'user_id' => $this->user->id,
            'partner_id' => $partner->id,
            'status' => 'pending',
        ]);

        $response = $this->actingAs($this->admin)
            ->get(route('admin.bookings', ['status' => 'pending']));

        $response->assertStatus(200);
        $response->assertSee('Pending');
    }

    /** @test */
    public function admin_can_view_partners_page()
    {
        $partner = Partner::factory()->create();

        $response = $this->actingAs($this->admin)
            ->get(route('admin.partners'));

        $response->assertStatus(200);
        $response->assertSee('Partner Management');
        $response->assertSee($partner->name);
    }

    /** @test */
    public function admin_can_view_companies_page()
    {
        $company = Company::factory()->create();

        $response = $this->actingAs($this->admin)
            ->get(route('admin.companies'));

        $response->assertStatus(200);
        $response->assertSee('Company Management');
        $response->assertSee($company->name);
    }

    /** @test */
    public function admin_can_view_memberships_page()
    {
        $membership = Membership::factory()->create();

        $response = $this->actingAs($this->admin)
            ->get(route('admin.memberships'));

        $response->assertStatus(200);
        $response->assertSee('Membership Management');
        $response->assertSee($membership->name);
    }

    /** @test */
    public function admin_can_access_settings_page()
    {
        $response = $this->actingAs($this->admin)
            ->get(route('admin.settings'));

        $response->assertStatus(200);
        $response->assertSee('System Settings');
        $response->assertSee('General Settings');
        $response->assertSee('Email Settings');
    }

    /** @test */
    public function admin_can_update_settings()
    {
        $response = $this->actingAs($this->admin)
            ->post(route('admin.settings.update'), [
                'app_name' => 'Test Wellness App',
                'max_bookings_per_user' => 15,
                'booking_advance_days' => 45,
            ]);

        $response->assertRedirect(route('admin.settings'));
        $response->assertSessionHas('success');
    }

    /** @test */
    public function admin_can_export_users()
    {
        $response = $this->actingAs($this->admin)
            ->get(route('admin.export', ['type' => 'users']));

        $response->assertStatus(200);
        $response->assertJsonStructure([
            '*' => [
                'id',
                'name',
                'email',
                'role',
                'created_at',
            ]
        ]);
    }

    /** @test */
    public function admin_can_export_bookings()
    {
        $partner = Partner::factory()->create();
        $booking = Booking::factory()->create([
            'user_id' => $this->user->id,
            'partner_id' => $partner->id,
        ]);

        $response = $this->actingAs($this->admin)
            ->get(route('admin.export', ['type' => 'bookings']));

        $response->assertStatus(200);
        $response->assertJsonStructure([
            '*' => [
                'id',
                'user_id',
                'partner_id',
                'booking_time',
                'status',
                'created_at',
            ]
        ]);
    }

    /** @test */
    public function dashboard_shows_correct_statistics()
    {
        // Create test data
        $partner = Partner::factory()->create();
        $company = Company::factory()->create();
        $membership = Membership::factory()->create();
        
        $booking = Booking::factory()->create([
            'user_id' => $this->user->id,
            'partner_id' => $partner->id,
            'status' => 'pending',
        ]);

        $response = $this->actingAs($this->admin)
            ->get(route('admin.dashboard'));

        $response->assertStatus(200);
        $response->assertSee('Total Users');
        $response->assertSee('Total Bookings');
        $response->assertSee('Active Partners');
        $response->assertSee('Total Companies');
    }

    /** @test */
    public function dashboard_shows_recent_activities()
    {
        $partner = Partner::factory()->create();
        $booking = Booking::factory()->create([
            'user_id' => $this->user->id,
            'partner_id' => $partner->id,
        ]);

        $response = $this->actingAs($this->admin)
            ->get(route('admin.dashboard'));

        $response->assertStatus(200);
        $response->assertSee('Recent Bookings');
        $response->assertSee($this->user->name);
        $response->assertSee($partner->name);
    }

    /** @test */
    public function dashboard_shows_quick_actions()
    {
        $response = $this->actingAs($this->admin)
            ->get(route('admin.dashboard'));

        $response->assertStatus(200);
        $response->assertSee('Quick Actions');
        $response->assertSee('Manage Users');
        $response->assertSee('View Bookings');
        $response->assertSee('Manage Partners');
        $response->assertSee('Settings');
    }
} 