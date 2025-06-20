@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
    <h2 class="text-2xl font-bold mb-6">{{ __('messages.welcome') }}, {{ Auth::user()->name }}!</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Membership Plan Card -->
        <div class="bg-blue-50 p-6 rounded-lg shadow">
            <h3 class="text-lg font-semibold text-blue-800 mb-2">{{ __('messages.dashboard') }} - {{ __('messages.companies') }}</h3>
            <p class="text-gray-700">Gold Plan</p>
            <p class="text-gray-500 text-sm mt-1">(Plan details will appear here)</p>
        </div>
        <!-- Recent Check-ins Card -->
        <div class="bg-green-50 p-6 rounded-lg shadow">
            <h3 class="text-lg font-semibold text-green-800 mb-2">{{ __('messages.active_bookings') }}</h3>
            <ul class="text-gray-700 text-sm list-disc ml-5">
                <li>Gym X - 2024-06-15</li>
                <li>Spa Y - 2024-06-14</li>
                <li>Sports Club Z - 2024-06-13</li>
            </ul>
        </div>
        <!-- Upcoming Bookings Card -->
        <div class="bg-purple-50 p-6 rounded-lg shadow">
            <h3 class="text-lg font-semibold text-purple-800 mb-2">{{ __('messages.bookings') }}</h3>
            <ul class="text-gray-700 text-sm list-disc ml-5">
                <li>Yoga Class @ Spa Y - 2024-06-18 10:00</li>
                <li>Football @ Sports Club Z - 2024-06-20 18:00</li>
            </ul>
        </div>
    </div>
    <div class="flex flex-col md:flex-row gap-4 mb-4">
        <a href="/partners" class="inline-block px-6 py-3 bg-blue-600 text-white rounded-lg font-semibold shadow hover:bg-blue-700 transition">{{ __('messages.partners') }}</a>
        <a href="/bookings" class="inline-block px-6 py-3 bg-green-600 text-white rounded-lg font-semibold shadow hover:bg-green-700 transition">{{ __('messages.bookings') }}</a>
    </div>
    <div class="mt-2">
        <a href="/companies/register" class="inline-block px-6 py-3 bg-gray-700 text-white rounded-lg font-semibold shadow hover:bg-gray-800 transition">Register a Company</a>
    </div>
    <div class="mt-2">
        <a href="/admin/users" class="inline-block px-6 py-3 bg-indigo-600 text-white rounded-lg font-semibold shadow hover:bg-indigo-700 transition">User Management</a>
    </div>
    <div class="mt-2">
        <a href="/admin/companies" class="inline-block px-6 py-3 bg-yellow-600 text-white rounded-lg font-semibold shadow hover:bg-yellow-700 transition">Company Management</a>
    </div>
    <div class="mt-2">
        <a href="/admin/memberships" class="inline-block px-6 py-3 bg-pink-600 text-white rounded-lg font-semibold shadow hover:bg-pink-700 transition">Membership Management</a>
    </div>
    <div class="mt-2">
        <a href="/admin/bookings" class="inline-block px-6 py-3 bg-red-600 text-white rounded-lg font-semibold shadow hover:bg-red-700 transition">Booking Management</a>
    </div>
    <div class="mt-2">
        <a href="/admin/partners" class="inline-block px-6 py-3 bg-green-700 text-white rounded-lg font-semibold shadow hover:bg-green-800 transition">Partner Management</a>
    </div>
    @if(auth()->user() && auth()->user()->isAdmin())
        <a href="{{ url('/admin/assign-membership') }}" class="inline-block bg-indigo-600 text-white px-4 py-2 rounded shadow hover:bg-indigo-700 transition mb-2 mr-2">Assign Memberships</a>
        <a href="{{ url('/admin/assign-role') }}" class="inline-block bg-pink-600 text-white px-4 py-2 rounded shadow hover:bg-pink-700 transition mb-2 mr-2">Assign Roles</a>
    @endif
</div>
@endsection
