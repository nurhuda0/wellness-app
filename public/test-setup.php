<?php
// Test Setup Script for Manual Testing
// Access this at: http://localhost:8000/test-setup.php

require_once __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\User;
use App\Models\Partner;
use App\Models\Company;
use Illuminate\Support\Facades\Hash;

echo "<h1>Wellness App - Test Data Setup</h1>";

// Create test company
$company = Company::firstOrCreate([
    'name' => 'Test Company',
    'email' => 'test@company.com'
], [
    'phone' => '123-456-7890',
    'address' => '123 Test Street',
    'city' => 'Test City',
    'status' => 'active'
]);

// Create test users
$users = [
    [
        'name' => 'Test User',
        'email' => 'user@test.com',
        'password' => 'password',
        'role' => 'employee'
    ],
    [
        'name' => 'Admin User',
        'email' => 'admin@test.com',
        'password' => 'password',
        'role' => 'hr_admin'
    ]
];

foreach ($users as $userData) {
    $user = User::firstOrCreate([
        'email' => $userData['email']
    ], [
        'name' => $userData['name'],
        'password' => Hash::make($userData['password']),
        'role' => $userData['role'],
        'company_id' => $company->id
    ]);
    
    echo "<p>✅ User created: {$user->email} (Password: {$userData['password']})</p>";
}

// Create test partners
$partners = [
    [
        'name' => 'Fitness First Gym',
        'type' => 'gym',
        'city' => 'Dubai',
        'description' => 'Premium fitness center with modern equipment',
        'phone' => '04-123-4567',
        'email' => 'info@fitnessfirst.ae',
        'website' => 'https://fitnessfirst.ae'
    ],
    [
        'name' => 'Serenity Spa',
        'type' => 'spa',
        'city' => 'Abu Dhabi',
        'description' => 'Luxury spa offering massage and wellness treatments',
        'phone' => '02-987-6543',
        'email' => 'book@serenityspa.ae',
        'website' => 'https://serenityspa.ae'
    ],
    [
        'name' => 'Sports Club Dubai',
        'type' => 'sports_club',
        'city' => 'Dubai',
        'description' => 'Multi-sport facility with swimming pool and tennis courts',
        'phone' => '04-555-1234',
        'email' => 'info@sportsclubdubai.ae',
        'website' => 'https://sportsclubdubai.ae'
    ]
];

foreach ($partners as $partnerData) {
    $partner = Partner::firstOrCreate([
        'name' => $partnerData['name']
    ], [
        'type' => $partnerData['type'],
        'city' => $partnerData['city'],
        'description' => $partnerData['description'],
        'address' => '123 ' . $partnerData['city'] . ' Street',
        'phone' => $partnerData['phone'],
        'email' => $partnerData['email'],
        'website' => $partnerData['website'],
        'status' => 'active'
    ]);
    
    echo "<p>✅ Partner created: {$partner->name} ({$partner->type})</p>";
}

echo "<hr>";
echo "<h2>🎯 Manual Testing Instructions</h2>";
echo "<p><strong>App URL:</strong> <a href='http://localhost:8000' target='_blank'>http://localhost:8000</a></p>";
echo "<p><strong>Test User:</strong> user@test.com / password</p>";
echo "<p><strong>Admin User:</strong> admin@test.com / password</p>";
echo "<p><strong>Partners:</strong> 3 test partners created</p>";

echo "<h3>📝 Test Scenarios to Try:</h3>";
echo "<ol>";
echo "<li>Login with test user</li>";
echo "<li>Browse partners directory</li>";
echo "<li>View partner details</li>";
echo "<li>Create a new booking</li>";
echo "<li>View booking calendar</li>";
echo "<li>Manage existing bookings</li>";
echo "</ol>";
?> 