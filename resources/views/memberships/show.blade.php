<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $membership->name }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('memberships.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Back to Plans
                </a>
                @if(Auth::user()->isAdmin())
                    <a href="{{ route('memberships.edit', $membership) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Edit Plan
                    </a>
                @endif
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Membership Details -->
                <div class="lg:col-span-2">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-6">
                                <h3 class="text-2xl font-bold text-gray-900">{{ $membership->name }}</h3>
                                @if($membership->is_featured)
                                    <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">Featured</span>
                                @endif
                            </div>

                            <div class="mb-6">
                                <div class="text-4xl font-bold text-gray-900 mb-2">
                                    {{ $membership->formatted_price }}
                                    <span class="text-lg text-gray-600">/{{ $membership->billing_cycle_text }}</span>
                                </div>
                                <p class="text-gray-600">{{ $membership->duration_text }} duration</p>
                            </div>

                            @if($membership->description)
                                <div class="mb-6">
                                    <h4 class="text-lg font-semibold text-gray-900 mb-2">Description</h4>
                                    <p class="text-gray-700">{{ $membership->description }}</p>
                                </div>
                            @endif

                            <!-- Features -->
                            <div class="mb-6">
                                <h4 class="text-lg font-semibold text-gray-900 mb-4">Features</h4>
                                <ul class="space-y-3">
                                    <li class="flex items-center">
                                        <svg class="h-5 w-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                        </svg>
                                        <span class="text-gray-700">{{ $membership->max_bookings_per_month }} bookings per month</span>
                                    </li>
                                    @foreach($membership->features_list as $feature)
                                        <li class="flex items-center">
                                            <svg class="h-5 w-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                            </svg>
                                            <span class="text-gray-700">{{ $feature }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                            <!-- Action Buttons -->
                            @if(Auth::user()->isAdmin())
                                <div class="space-y-3">
                                    <form action="{{ route('memberships.destroy', $membership) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="w-full bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"
                                                onclick="return confirm('Are you sure you want to delete this membership plan?')">
                                            Delete Plan
                                        </button>
                                    </form>
                                </div>
                            @else
                                @if(Auth::user()->hasActiveMembership() && Auth::user()->membership_id == $membership->id)
                                    <button disabled class="w-full bg-green-500 text-white font-bold py-2 px-4 rounded opacity-50 cursor-not-allowed">
                                        Your Current Plan
                                    </button>
                                @else
                                    <div class="space-y-3">
                                        <button class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                            Choose This Plan
                                        </button>
                                        <p class="text-sm text-gray-600 text-center">
                                            Contact an administrator to assign this membership to your account.
                                        </p>
                                    </div>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="lg:col-span-1">
                    <!-- Plan Stats -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                        <div class="p-6">
                            <h4 class="text-lg font-semibold text-gray-900 mb-4">Plan Statistics</h4>
                            <div class="space-y-3">
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Total Users:</span>
                                    <span class="font-semibold">{{ $membership->users_count ?? 0 }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Active Users:</span>
                                    <span class="font-semibold">{{ $membership->active_users_count }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Status:</span>
                                    <span class="font-semibold {{ $membership->is_active ? 'text-green-600' : 'text-red-600' }}">
                                        {{ $membership->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Users -->
                    @if($membership->users->count() > 0)
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6">
                                <h4 class="text-lg font-semibold text-gray-900 mb-4">Recent Members</h4>
                                <div class="space-y-3">
                                    @foreach($membership->users->take(5) as $user)
                                        <div class="flex items-center justify-between">
                                            <div>
                                                <p class="text-sm font-medium text-gray-900">{{ $user->name }}</p>
                                                <p class="text-xs text-gray-500">{{ $user->email }}</p>
                                            </div>
                                            <span class="text-xs text-gray-500">
                                                {{ $user->membership_expires_at?->format('M j') }}
                                            </span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
