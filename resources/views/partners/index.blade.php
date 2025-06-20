@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
            <div class="space-y-6">
                <!-- Search and Filter -->
                <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                    <h2 class="text-2xl font-bold text-gray-900">{{ __('Partners Directory') }}</h2>
                    
                    <div class="flex gap-4">
                        <!-- Search Input -->
                        <div class="relative">
                            <input type="text" id="search" 
                                   class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                   placeholder="{{ __('Search partners...') }}">
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                            </div>
                        </div>

                        <!-- Type Filter -->
                        <select id="typeFilter" 
                                class="px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">{{ __('All Types') }}</option>
                            <option value="gym">{{ __('Gym') }}</option>
                            <option value="spa">{{ __('Spa') }}</option>
                            <option value="sports">{{ __('Sports Club') }}</option>
                            <option value="wellness_center">{{ __('Wellness Center') }}</option>
                        </select>
                    </div>
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
                                <div class="flex items-center gap-4">
                                    <div class="flex items-center">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        </svg>
                                        <span class="ml-2 text-gray-600">{{ $partner->city }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4">
                                <a href="{{ route('partners.show', $partner) }}" 
                                   class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    {{ __('View Details') }}
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
// Client-side filtering
const partners = document.querySelectorAll('.bg-white');
const searchInput = document.getElementById('search');
const typeFilter = document.getElementById('typeFilter');

searchInput.addEventListener('input', filterPartners);
typeFilter.addEventListener('change', filterPartners);

function filterPartners() {
    const searchTerm = searchInput.value.toLowerCase();
    const selectedType = typeFilter.value;
    
    partners.forEach(partner => {
        const name = partner.querySelector('h3').textContent.toLowerCase();
        const type = partner.querySelector('.bg-green-100').textContent.toLowerCase();
        const city = partner.querySelector('.text-gray-600:last-child').textContent.toLowerCase();
        
        const matchesSearch = name.includes(searchTerm) || 
                            city.includes(searchTerm) ||
                            type.includes(searchTerm);
        const matchesType = selectedType === '' || type === selectedType;
        
        partner.style.display = matchesSearch && matchesType ? 'block' : 'none';
    });
}
</script>
@endpush
@endsection
