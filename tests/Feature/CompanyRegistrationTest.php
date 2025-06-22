<?php

namespace Tests\Feature;

use App\Models\Company;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CompanyRegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_company_registration_page_loads()
    {
        $response = $this->get('/companies/register');
        
        $response->assertStatus(200);
        $response->assertSee('Register Your Company');
        $response->assertSee('Company Name');
        $response->assertSee('HR Contact Email');
    }

    public function test_company_registration_requires_valid_data()
    {
        $response = $this->post('/companies/register', [
            'company_name' => '',
            'hr_email' => 'invalid-email',
            'password' => '123',
            'password_confirmation' => '456',
        ]);

        $response->assertSessionHasErrors([
            'company_name',
            'hr_email',
            'password',
        ]);
    }

    public function test_company_registration_creates_company_and_hr_user()
    {
        $response = $this->post('/companies/register', [
            'company_name' => 'Test Company',
            'hr_email' => 'hr@testcompany.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertRedirect('/login');
        $response->assertSessionHas('success');

        // Check that company was created
        $this->assertDatabaseHas('companies', [
            'name' => 'Test Company',
            'hr_email' => 'hr@testcompany.com',
            'status' => 'active',
        ]);

        // Check that HR user was created
        $this->assertDatabaseHas('users', [
            'name' => 'Test Company HR',
            'email' => 'hr@testcompany.com',
            'role' => User::ROLE_HR_ADMIN,
        ]);

        // Check that user is linked to company
        $company = Company::where('name', 'Test Company')->first();
        $user = User::where('email', 'hr@testcompany.com')->first();
        
        $this->assertEquals($company->id, $user->company_id);
    }

    public function test_company_registration_prevents_duplicate_emails()
    {
        // Create a user with the same email first
        User::factory()->create(['email' => 'hr@testcompany.com']);

        $response = $this->post('/companies/register', [
            'company_name' => 'Test Company',
            'hr_email' => 'hr@testcompany.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertSessionHasErrors(['hr_email']);
    }

    public function test_company_user_relationship_works()
    {
        // Create a company
        $company = Company::create([
            'name' => 'Test Company',
            'hr_email' => 'hr@testcompany.com',
            'status' => 'active',
        ]);

        // Create a user linked to the company
        $user = User::create([
            'name' => 'Test User',
            'email' => 'user@testcompany.com',
            'password' => bcrypt('password'),
            'role' => User::ROLE_EMPLOYEE,
            'company_id' => $company->id,
        ]);

        // Test the relationship
        $this->assertEquals($company->id, $user->company->id);
        $this->assertEquals($company->name, $user->company->name);
        
        // Test the inverse relationship
        $this->assertTrue($company->users->contains($user));
    }

    public function test_hr_admin_role_is_assigned_correctly()
    {
        $response = $this->post('/companies/register', [
            'company_name' => 'Test Company',
            'hr_email' => 'hr@testcompany.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $user = User::where('email', 'hr@testcompany.com')->first();
        
        $this->assertEquals(User::ROLE_HR_ADMIN, $user->role);
        $this->assertTrue($user->isAdmin());
    }
}
