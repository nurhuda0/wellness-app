@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Current Plan Card -->
                <div class="bg-blue-50 p-6 rounded-lg shadow">
                    <h3 class="text-lg font-semibold text-blue-800 mb-4">{{ __('Current Membership Plan') }}</h3>
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="h-12 w-12 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h4 class="text-xl font-semibold text-gray-900">{{ $user->membership->name }}</h4>
                            <p class="mt-1 text-sm text-gray-600">{{ $user->membership->description }}</p>
                        </div>
                    </div>
                </div>

                <!-- Recent Check-ins Card -->
                <div class="bg-green-50 p-6 rounded-lg shadow">
                    <h3 class="text-lg font-semibold text-green-800 mb-4">{{ __('Recent Check-ins') }}</h3>
                    <div class="space-y-4">
                        @forelse($checkIns as $checkIn)
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <svg class="h-6 w-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm text-gray-900">{{ $checkIn->partner->name }}</p>
                                    <p class="text-xs text-gray-500">{{ $checkIn->created_at->format('M d, Y') }}</p>
                                </div>
                            </div>
                        @empty
                            <p class="text-sm text-gray-600">{{ __('No recent check-ins') }}</p>
                        @endforelse
                    </div>
                </div>

                <!-- Upcoming Bookings Card -->
                <div class="bg-purple-50 p-6 rounded-lg shadow">
                    <h3 class="text-lg font-semibold text-purple-800 mb-4">{{ __('Upcoming Bookings') }}</h3>
                    <div class="space-y-4">
                        @forelse($bookings as $booking)
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <svg class="h-6 w-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm text-gray-900">{{ $booking->partner->name }}</p>
                                    <p class="text-xs text-gray-500">{{ $booking->booking_date->format('M d, Y H:i') }}</p>
                                </div>
                            </div>
                        @empty
                            <p class="text-sm text-gray-600">{{ __('No upcoming bookings') }}</p>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Partner Directory Section -->
            <div class="mt-8">
                <h2 class="text-2xl font-semibold text-gray-900 mb-4">{{ __('Partners Directory') }}</h2>
                
                <!-- Search and Filter -->
                <div class="flex space-x-4 mb-4">
                    <div class="flex-1">
                        <input type="text" placeholder="{{ __('Search partners...') }}" 
                               class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <select class="px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">{{ __('All Types') }}</option>
                        <option value="gym">{{ __('Gym') }}</option>
                        <option value="spa">{{ __('Spa') }}</option>
                        <option value="sports">{{ __('Sports Club') }}</option>
                    </select>
                </div>

                <!-- Partners Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($partners as $partner)
                        <div class="bg-white p-6 rounded-lg shadow">
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-semibold text-gray-900">{{ $partner->name }}</h3>
                                <span class="px-3 py-1 text-xs font-semibold text-green-800 bg-green-100 rounded-full">
                                    {{ $partner->type }}
                                </span>
                            </div>
                            <p class="mt-2 text-gray-600">{{ $partner->description }}</p>
                            <div class="mt-4">
                                <button onclick="window.location.href='{{ route('partners.show', $partner) }}'" 
                                        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    {{ __('View Details') }}
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
