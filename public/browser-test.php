<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wellness App - Browser Testing</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-6xl mx-auto">
            <h1 class="text-3xl font-bold text-gray-800 mb-8">🧪 Wellness App - Manual Testing Dashboard</h1>
            
            <!-- Quick Setup -->
            <div class="bg-green-50 border border-green-200 rounded-lg p-6 mb-8">
                <h2 class="text-xl font-semibold mb-4 text-green-800">🚀 Quick Setup</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <a href="test-setup.php" target="_blank" class="bg-green-500 text-white p-4 rounded-lg hover:bg-green-600 text-center">
                        <div class="font-semibold">1. Setup Test Data</div>
                        <div class="text-sm opacity-90">Create users & partners</div>
                    </a>
                    <a href="http://localhost:8000" target="_blank" class="bg-blue-500 text-white p-4 rounded-lg hover:bg-blue-600 text-center">
                        <div class="font-semibold">2. Open Main App</div>
                        <div class="text-sm opacity-90">Start testing</div>
                    </a>
                    <a href="MANUAL_TESTING_GUIDE.md" target="_blank" class="bg-purple-500 text-white p-4 rounded-lg hover:bg-purple-600 text-center">
                        <div class="font-semibold">3. View Test Guide</div>
                        <div class="text-sm opacity-90">Detailed instructions</div>
                    </a>
                </div>
            </div>

            <!-- Test Credentials -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-8">
                <h2 class="text-xl font-semibold mb-4">👤 Test Credentials</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="border-2 border-blue-200 rounded-lg p-4 bg-blue-50">
                        <h3 class="font-semibold text-blue-800 mb-2">Regular User</h3>
                        <p class="text-sm text-blue-700"><strong>Email:</strong> user@test.com</p>
                        <p class="text-sm text-blue-700"><strong>Password:</strong> password</p>
                        <p class="text-xs text-blue-600 mt-2">Use for testing booking features</p>
                    </div>
                    <div class="border-2 border-green-200 rounded-lg p-4 bg-green-50">
                        <h3 class="font-semibold text-green-800 mb-2">Admin User</h3>
                        <p class="text-sm text-green-700"><strong>Email:</strong> admin@test.com</p>
                        <p class="text-sm text-green-700"><strong>Password:</strong> password</p>
                        <p class="text-xs text-green-600 mt-2">Use for testing admin features</p>
                    </div>
                </div>
            </div>

            <!-- Feature Testing -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Authentication Testing -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-semibold mb-4 text-blue-800">🔐 Authentication Testing</h2>
                    <div class="space-y-3">
                        <a href="http://localhost:8000/login" target="_blank" class="block bg-blue-500 text-white p-3 rounded hover:bg-blue-600 text-center">
                            Test Login Page
                        </a>
                        <a href="http://localhost:8000/register" target="_blank" class="block bg-green-500 text-white p-3 rounded hover:bg-green-600 text-center">
                            Test Registration Page
                        </a>
                        <div class="text-sm text-gray-600 mt-4">
                            <strong>Test Steps:</strong>
                            <ol class="list-decimal list-inside mt-2 space-y-1">
                                <li>Try logging in with test credentials</li>
                                <li>Test logout functionality</li>
                                <li>Try accessing protected pages without login</li>
                            </ol>
                        </div>
                    </div>
                </div>

                <!-- Partner Directory Testing -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-semibold mb-4 text-green-800">🏢 Partner Directory Testing</h2>
                    <div class="space-y-3">
                        <a href="http://localhost:8000/partners" target="_blank" class="block bg-green-500 text-white p-3 rounded hover:bg-green-600 text-center">
                            Browse Partners
                        </a>
                        <a href="http://localhost:8000/partners/1" target="_blank" class="block bg-blue-500 text-white p-3 rounded hover:bg-blue-600 text-center">
                            View Partner Details
                        </a>
                        <div class="text-sm text-gray-600 mt-4">
                            <strong>Test Steps:</strong>
                            <ol class="list-decimal list-inside mt-2 space-y-1">
                                <li>Browse partner list</li>
                                <li>Test filtering by city/type</li>
                                <li>View individual partner details</li>
                            </ol>
                        </div>
                    </div>
                </div>

                <!-- Booking System Testing -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-semibold mb-4 text-purple-800">📅 Booking System Testing</h2>
                    <div class="space-y-3">
                        <a href="http://localhost:8000/bookings" target="_blank" class="block bg-purple-500 text-white p-3 rounded hover:bg-purple-600 text-center">
                            View Bookings
                        </a>
                        <a href="http://localhost:8000/bookings/create" target="_blank" class="block bg-blue-500 text-white p-3 rounded hover:bg-blue-600 text-center">
                            Create New Booking
                        </a>
                        <a href="http://localhost:8000/bookings/calendar" target="_blank" class="block bg-green-500 text-white p-3 rounded hover:bg-green-600 text-center">
                            Calendar View
                        </a>
                        <div class="text-sm text-gray-600 mt-4">
                            <strong>Test Steps:</strong>
                            <ol class="list-decimal list-inside mt-2 space-y-1">
                                <li>Create a new booking</li>
                                <li>View booking calendar</li>
                                <li>Edit existing bookings</li>
                                <li>Cancel bookings</li>
                            </ol>
                        </div>
                    </div>
                </div>

                <!-- Admin Panel Testing -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-semibold mb-4 text-red-800">⚙️ Admin Panel Testing</h2>
                    <div class="space-y-3">
                        <a href="http://localhost:8000/admin" target="_blank" class="block bg-red-500 text-white p-3 rounded hover:bg-red-600 text-center">
                            Admin Dashboard
                        </a>
                        <a href="http://localhost:8000/admin/users" target="_blank" class="block bg-blue-500 text-white p-3 rounded hover:bg-blue-600 text-center">
                            User Management
                        </a>
                        <a href="http://localhost:8000/admin/bookings" target="_blank" class="block bg-green-500 text-white p-3 rounded hover:bg-green-600 text-center">
                            Booking Management
                        </a>
                        <div class="text-sm text-gray-600 mt-4">
                            <strong>Test Steps:</strong>
                            <ol class="list-decimal list-inside mt-2 space-y-1">
                                <li>Login as admin user</li>
                                <li>Access admin dashboard</li>
                                <li>Manage users and bookings</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Testing Checklist -->
            <div class="bg-white rounded-lg shadow-md p-6 mt-8">
                <h2 class="text-xl font-semibold mb-4">✅ Testing Checklist</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h3 class="font-semibold text-gray-800 mb-3">Core Features</h3>
                        <div class="space-y-2">
                            <label class="flex items-center">
                                <input type="checkbox" class="mr-2"> User authentication works
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="mr-2"> Partner directory displays correctly
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="mr-2"> Booking creation works
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="mr-2"> Booking calendar displays correctly
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="mr-2"> Admin panel accessible
                            </label>
                        </div>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-800 mb-3">User Experience</h3>
                        <div class="space-y-2">
                            <label class="flex items-center">
                                <input type="checkbox" class="mr-2"> Mobile responsive design
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="mr-2"> Error handling works
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="mr-2"> Data persistence verified
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="mr-2"> Navigation is intuitive
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="mr-2"> Forms validate correctly
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Troubleshooting -->
            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-6 mt-8">
                <h2 class="text-xl font-semibold mb-4 text-yellow-800">🔧 Troubleshooting</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h3 class="font-semibold text-yellow-800 mb-2">Common Issues</h3>
                        <ul class="text-sm text-yellow-700 space-y-1">
                            <li>• Server not starting: Check port 8000 availability</li>
                            <li>• Database errors: Run <code>php artisan migrate:fresh --seed</code></li>
                            <li>• Styling issues: Run <code>npm run dev</code></li>
                            <li>• Permission errors: Check storage directory permissions</li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="font-semibold text-yellow-800 mb-2">Useful Commands</h3>
                        <ul class="text-sm text-yellow-700 space-y-1">
                            <li>• <code>php artisan serve</code> - Start server</li>
                            <li>• <code>php artisan route:clear</code> - Clear routes</li>
                            <li>• <code>php artisan config:clear</code> - Clear config</li>
                            <li>• <code>npm run dev</code> - Compile assets</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html> 