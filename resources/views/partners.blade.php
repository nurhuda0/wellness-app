@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
    <h2 class="text-2xl font-bold mb-6">{{ __('messages.partners') }}</h2>
    <div class="flex flex-col md:flex-row gap-4 mb-6">
        <input type="text" placeholder="{{ __('messages.search') ?? 'Search partners...' }}" class="flex-1 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" />
        <select class="px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            <option value="">All Cities</option>
            <option value="Riyadh">Riyadh</option>
            <option value="Jeddah">Jeddah</option>
            <option value="Dammam">Dammam</option>
        </select>
        <select class="px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            <option value="">All Types</option>
            <option value="gym">{{ __('messages.gym') ?? 'Gym' }}</option>
            <option value="spa">{{ __('messages.spa') ?? 'Spa' }}</option>
            <option value="sports">{{ __('messages.sports_club') ?? 'Sports Club' }}</option>
        </select>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Partner Card Example -->
        <div class="bg-white p-6 rounded-lg shadow">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-semibold text-gray-900">Gym X</h3>
                <span class="px-3 py-1 text-xs font-semibold text-green-800 bg-green-100 rounded-full">{{ __('messages.gym') ?? 'Gym' }}</span>
            </div>
            <p class="mt-2 text-gray-600">A modern gym with all facilities in Riyadh.</p>
            <div class="mt-4">
                <button class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">{{ __('messages.view_details') ?? 'View Details' }}</button>
            </div>
        </div>
        <div class="bg-white p-6 rounded-lg shadow">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-semibold text-gray-900">Spa Y</h3>
                <span class="px-3 py-1 text-xs font-semibold text-blue-800 bg-blue-100 rounded-full">{{ __('messages.spa') ?? 'Spa' }}</span>
            </div>
            <p class="mt-2 text-gray-600">Luxury spa and wellness center in Jeddah.</p>
            <div class="mt-4">
                <button class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">{{ __('messages.view_details') ?? 'View Details' }}</button>
            </div>
        </div>
        <div class="bg-white p-6 rounded-lg shadow">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-semibold text-gray-900">Sports Club Z</h3>
                <span class="px-3 py-1 text-xs font-semibold text-purple-800 bg-purple-100 rounded-full">{{ __('messages.sports_club') ?? 'Sports Club' }}</span>
            </div>
            <p class="mt-2 text-gray-600">Football and tennis club in Dammam.</p>
            <div class="mt-4">
                <button class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">{{ __('messages.view_details') ?? 'View Details' }}</button>
            </div>
        </div>
    </div>
</div>
@endsection 