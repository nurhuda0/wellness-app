<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Wellness App - Your Wellness, Our Priority</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        <script src="https://cdn.tailwindcss.com"></script>
        <style>
            body {
                font-family: 'Figtree', sans-serif;
            }
            .bg-dots-dark {
                background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E");
            }
        </style>
    </head>
    <body class="bg-gray-50 min-h-screen flex flex-col">
        <!-- Hero Section -->
        <section class="bg-gradient-to-br from-blue-100 to-blue-300 py-16 px-4 flex-1 flex flex-col items-center justify-center">
            <div class="max-w-2xl text-center">
                <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-4">Welcome to Wellness App</h1>
                <p class="text-lg md:text-2xl text-gray-700 mb-8">Your one-stop platform for booking wellness services, exclusive memberships, and connecting with top partners in the industry.</p>
                <div class="flex flex-col md:flex-row gap-4 justify-center mb-8">
                    <a href="#offers" class="px-8 py-3 bg-blue-600 text-white rounded-lg text-lg font-semibold shadow hover:bg-blue-700 transition">See Offers</a>
                    <a href="#partners" class="px-8 py-3 bg-white border border-blue-600 text-blue-600 rounded-lg text-lg font-semibold shadow hover:bg-blue-50 transition">Our Partners</a>
                </div>
                <div class="flex flex-col md:flex-row gap-4 justify-center">
                    <a href="{{ route('login') }}" class="px-8 py-3 bg-red-400/80 text-white rounded-lg text-lg font-semibold shadow hover:bg-red-600 transition">Log in</a>
                    <a href="{{ route('register') }}" class="px-8 py-3 bg-red-300/80 text-white rounded-lg text-lg font-semibold shadow hover:bg-red-500 transition">Register</a>
                </div>
            </div>
        </section>

        <!-- Offers Section -->
        <section id="offers" class="py-16 bg-white">
            <div class="max-w-5xl mx-auto px-4">
                <h2 class="text-3xl font-bold text-center text-gray-900 mb-8">Our Membership Offers</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Sample Offer 1 -->
                    <div class="bg-blue-50 rounded-lg shadow p-6 flex flex-col items-center">
                        <h3 class="text-xl font-bold text-blue-800 mb-2">Basic Membership</h3>
                        <p class="text-3xl font-extrabold text-blue-900 mb-2">$19/mo</p>
                        <ul class="text-gray-700 mb-4 space-y-1">
                            <li>✔ 5 bookings/month</li>
                            <li>✔ Access to standard partners</li>
                            <li>✔ Email support</li>
                        </ul>
                        <a href="#" class="mt-auto px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">Get Started</a>
                    </div>
                    <!-- Sample Offer 2 -->
                    <div class="bg-yellow-50 rounded-lg shadow p-6 flex flex-col items-center border-2 border-yellow-400">
                        <h3 class="text-xl font-bold text-yellow-800 mb-2">Premium Membership</h3>
                        <p class="text-3xl font-extrabold text-yellow-900 mb-2">$39/mo</p>
                        <ul class="text-gray-700 mb-4 space-y-1">
                            <li>✔ 15 bookings/month</li>
                            <li>✔ Priority partner access</li>
                            <li>✔ Phone & email support</li>
                            <li>✔ Free wellness events</li>
                        </ul>
                        <a href="#" class="mt-auto px-6 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600 transition">Get Started</a>
                    </div>
                    <!-- Sample Offer 3 -->
                    <div class="bg-green-50 rounded-lg shadow p-6 flex flex-col items-center">
                        <h3 class="text-xl font-bold text-green-800 mb-2">Elite Membership</h3>
                        <p class="text-3xl font-extrabold text-green-900 mb-2">$79/mo</p>
                        <ul class="text-gray-700 mb-4 space-y-1">
                            <li>✔ Unlimited bookings</li>
                            <li>✔ VIP partner access</li>
                            <li>✔ 24/7 concierge support</li>
                            <li>✔ Exclusive gifts</li>
                        </ul>
                        <a href="#" class="mt-auto px-6 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition">Get Started</a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Partners Section -->
        <section id="partners" class="py-16 bg-gray-50">
            <div class="max-w-5xl mx-auto px-4">
                <h2 class="text-3xl font-bold text-center text-gray-900 mb-8">Our Trusted Partners</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Sample Partner 1 -->
                    <div class="bg-white rounded-lg shadow p-6 flex flex-col items-center">
                        <img src="https://placehold.co/80x80" alt="Partner 1" class="mb-4 rounded-full">
                        <h3 class="text-lg font-bold text-gray-800 mb-1">Zen Spa</h3>
                        <p class="text-gray-600 text-center mb-2">Premium spa and wellness center in the city.</p>
                        <span class="text-sm text-blue-600">City: New York</span>
                    </div>
                    <!-- Sample Partner 2 -->
                    <div class="bg-white rounded-lg shadow p-6 flex flex-col items-center">
                        <img src="https://placehold.co/80x80" alt="Partner 2" class="mb-4 rounded-full">
                        <h3 class="text-lg font-bold text-gray-800 mb-1">FitLife Gym</h3>
                        <p class="text-gray-600 text-center mb-2">Modern gym with personal trainers and group classes.</p>
                        <span class="text-sm text-blue-600">City: Los Angeles</span>
                    </div>
                    <!-- Sample Partner 3 -->
                    <div class="bg-white rounded-lg shadow p-6 flex flex-col items-center">
                        <img src="https://placehold.co/80x80" alt="Partner 3" class="mb-4 rounded-full">
                        <h3 class="text-lg font-bold text-gray-800 mb-1">Healthy Eats</h3>
                        <p class="text-gray-600 text-center mb-2">Nutritious meal plans and healthy food delivery.</p>
                        <span class="text-sm text-blue-600">City: Chicago</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="py-8 bg-gray-900 text-gray-200 text-center mt-auto">
            <div class="container mx-auto">
                &copy; {{ date('Y') }} Wellness App. All rights reserved.
            </div>
        </footer>
    </body>
</html>
