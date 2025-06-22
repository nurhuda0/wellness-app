@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
            <div class="space-y-6">
                <!-- Search and Filter -->
                <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                    <h2 class="text-2xl font-bold text-gray-900">{{ __('Partners Directory') }}</h2>
                    
                    <!-- Filter Form -->
                    <form method="GET" action="{{ route('partners.index') }}" class="flex gap-4">
                        <!-- City Filter -->
                        <select name="city" 
                                class="px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">{{ __('All Cities') }}</option>
                            @foreach($cities as $city)
                                <option value="{{ $city }}" {{ request('city') == $city ? 'selected' : '' }}>
                                    {{ $city }}
                                </option>
                            @endforeach
                        </select>

                        <!-- Type Filter -->
                        <select name="type" 
                                class="px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">{{ __('All Types') }}</option>
                            @foreach($types as $key => $type)
                                <option value="{{ $key }}" {{ request('type') == $key ? 'selected' : '' }}>
                                    {{ $type }}
                                </option>
                            @endforeach
                        </select>

                        <button type="submit" 
                                class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            {{ __('Filter') }}
                        </button>
                    </form>
                </div>

                <!-- Results Count -->
                <div class="text-sm text-gray-600">
                    {{ __('Showing') }} {{ $partners->firstItem() ?? 0 }} - {{ $partners->lastItem() ?? 0 }} 
                    {{ __('of') }} {{ $partners->total() }} {{ __('partners') }}
                </div>

                <!-- Partners Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse($partners as $partner)
                        <div class="bg-white p-6 rounded-lg shadow border hover:shadow-lg transition-shadow">
                            <div class="flex items-center justify-between mb-3">
                                <h3 class="text-lg font-semibold text-gray-900">{{ $partner->name }}</h3>
                                <span class="px-3 py-1 text-xs font-semibold text-green-800 bg-green-100 rounded-full">
                                    {{ $types[$partner->type] ?? $partner->type }}
                                </span>
                            </div>
                            
                            @if($partner->description)
                                <p class="text-gray-600 text-sm mb-3 line-clamp-2">{{ $partner->description }}</p>
                            @endif
                            
                            <div class="space-y-2 mb-4">
                                <div class="flex items-center text-sm text-gray-600">
                                    <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    </svg>
                                    <span>{{ $partner->city }}</span>
                                </div>
                                
                                @if($partner->phone)
                                    <div class="flex items-center text-sm text-gray-600">
                                        <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                        </svg>
                                        <span>{{ $partner->phone }}</span>
                                    </div>
                                @endif
                            </div>
                            
                            <div class="flex gap-2">
                                <a href="{{ route('partners.show', $partner) }}" 
                                   class="flex-1 inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    {{ __('View Details') }}
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full text-center py-12">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">{{ __('No partners found') }}</h3>
                            <p class="mt-1 text-sm text-gray-500">{{ __('Try adjusting your filters or search criteria.') }}</p>
                        </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                @if($partners->hasPages())
                    <div class="mt-6">
                        {{ $partners->appends(request()->query())->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
