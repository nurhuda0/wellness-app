<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Membership Plans') }}
            </h2>
            @if(Auth::user()->isAdmin())
                <a href="{{ route('memberships.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Create Plan
                </a>
            @endif
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Current Membership Status -->
            @if(Auth::user()->hasActiveMembership())
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-6 mb-8">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-semibold text-blue-900">
                                Your Current Membership: {{ Auth::user()->membership->name }}
                            </h3>
                            <p class="text-blue-700 mt-1">
                                Status: {{ Auth::user()->membership_status }} | 
                                Days Left: {{ Auth::user()->membership_days_left }} | 
                                Remaining Bookings: {{ Auth::user()->remaining_bookings }}
                            </p>
                        </div>
                        <div class="text-right">
                            <p class="text-sm text-blue-600">
                                Expires: {{ Auth::user()->membership_expires_at?->format('M j, Y') }}
                            </p>
                        </div>
                    </div>
                </div>
            @else
                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-6 mb-8">
                    <div class="flex items-center">
                        <svg class="h-5 w-5 text-yellow-400 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                        </svg>
                        <p class="text-yellow-800">
                            You don't have an active membership. Choose a plan below to start booking wellness services.
                        </p>
                    </div>
                </div>
            @endif

            <!-- Membership Plans Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($memberships as $membership)
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden {{ $membership->is_featured ? 'ring-2 ring-blue-500' : '' }}">
                        @if($membership->is_featured)
                            <div class="bg-blue-500 text-white text-center py-2">
                                <span class="text-sm font-semibold">Most Popular</span>
                            </div>
                        @endif
                        
                        <div class="p-6">
                            <h3 class="text-2xl font-bold text-gray-900 mb-2">{{ $membership->name }}</h3>
                            <div class="mb-4">
                                <span class="text-4xl font-bold text-gray-900">{{ $membership->formatted_price }}</span>
                                <span class="text-gray-600">/{{ $membership->billing_cycle_text }}</span>
                            </div>
                            
                            @if($membership->description)
                                <p class="text-gray-600 mb-6">{{ $membership->description }}</p>
                            @endif

                            <!-- Features -->
                            <ul class="space-y-3 mb-6">
                                <li class="flex items-center">
                                    <svg class="h-5 w-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span class="text-gray-700">{{ $membership->max_bookings_per_month }} bookings per month</span>
                                </li>
                                @foreach($membership->features_list as $feature)
                                    <li class="flex items-center">
                                        <svg class="h-5 w-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                        </svg>
                                        <span class="text-gray-700">{{ $feature }}</span>
                                    </li>
                                @endforeach
                            </ul>

                            <!-- Action Buttons -->
                            <div class="space-y-2">
                                @if(Auth::user()->isAdmin())
                                    <a href="{{ route('memberships.edit', $membership) }}" 
                                       class="w-full bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded block text-center">
                                        Edit Plan
                                    </a>
                                @else
                                    @if(Auth::user()->hasActiveMembership() && Auth::user()->membership_id == $membership->id)
                                        <button disabled class="w-full bg-green-500 text-white font-bold py-2 px-4 rounded opacity-50 cursor-not-allowed">
                                            Current Plan
                                        </button>
                                    @else
                                        <a href="{{ route('memberships.show', $membership) }}" 
                                           class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded block text-center">
                                            View Details
                                        </a>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">No membership plans available</h3>
                        <p class="mt-1 text-sm text-gray-500">Get started by creating a new membership plan.</p>
                        @if(Auth::user()->isAdmin())
                            <div class="mt-6">
                                <a href="{{ route('memberships.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                                    Create Plan
                                </a>
                            </div>
                        @endif
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout> 