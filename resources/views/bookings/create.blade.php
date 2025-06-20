@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
            <div class="space-y-6">
                <!-- Partner Information -->
                <div>
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">{{ __('Book Session at') }} {{ $partner->name }}</h2>
                    <div class="bg-blue-50 p-4 rounded-lg">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg class="h-6 w-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold text-gray-900">{{ $partner->name }}</h3>
                                <p class="text-sm text-gray-600">{{ $partner->description }}</p>
                                <p class="text-sm text-gray-600">{{ $partner->city }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Booking Form -->
                <form action="{{ route('bookings.store') }}" method="POST" class="space-y-6">
                    @csrf
                    
                    <input type="hidden" name="partner_id" value="{{ $partner->id }}">

                    <!-- Date and Time Selection -->
                    <div>
                        <label for="booking_date" class="block text-sm font-medium text-gray-700">{{ __('Select Date and Time') }}</label>
                        <div class="mt-1">
                            <input type="datetime-local" id="booking_date" name="booking_date" 
                                   class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                   required>
                        </div>
                    </div>

                    <!-- Number of Participants -->
                    <div>
                        <label for="participants" class="block text-sm font-medium text-gray-700">{{ __('Number of Participants') }}</label>
                        <div class="mt-1">
                            <input type="number" id="participants" name="participants" min="1" max="10"
                                   class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                   required>
                        </div>
                    </div>

                    <!-- Notes -->
                    <div>
                        <label for="notes" class="block text-sm font-medium text-gray-700">{{ __('Additional Notes') }}</label>
                        <div class="mt-1">
                            <textarea id="notes" name="notes" rows="3"
                                      class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                      placeholder="{{ __('Any special requirements or notes...') }}"></textarea>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div>
                        <button type="submit" 
                                class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            {{ __('Book Session') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
