@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
            <!-- Back Button -->
            <div class="mb-6">
                <a href="{{ route('partners.index') }}" 
                   class="inline-flex items-center text-sm text-blue-600 hover:text-blue-800">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                    {{ __('Back to Partners') }}
                </a>
            </div>

            <!-- Partner Header -->
            <div class="border-b border-gray-200 pb-6 mb-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">{{ $partner->name }}</h1>
                        <div class="flex items-center mt-2">
                            <span class="px-3 py-1 text-sm font-semibold text-green-800 bg-green-100 rounded-full">
                                {{ \App\Models\Partner::getTypes()[$partner->type] ?? $partner->type }}
                            </span>
                            <span class="ml-4 text-gray-600">{{ $partner->city }}</span>
                        </div>
                    </div>
                    
                    @auth
                        <a href="{{ route('bookings.create', ['partner' => $partner->id]) }}" 
                           class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            {{ __('Book Session') }}
                        </a>
                    @endauth
                </div>
            </div>

            <!-- Partner Details -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Main Content -->
                <div class="lg:col-span-2">
                    @if($partner->description)
                        <div class="mb-8">
                            <h2 class="text-xl font-semibold text-gray-900 mb-4">{{ __('About') }}</h2>
                            <p class="text-gray-700 leading-relaxed">{{ $partner->description }}</p>
                        </div>
                    @endif

                    <!-- Contact Information -->
                    <div class="bg-gray-50 rounded-lg p-6">
                        <h2 class="text-xl font-semibold text-gray-900 mb-4">{{ __('Contact Information') }}</h2>
                        <div class="space-y-3">
                            @if($partner->address)
                                <div class="flex items-start">
                                    <svg class="h-5 w-5 text-gray-400 mt-0.5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">{{ __('Address') }}</p>
                                        <p class="text-sm text-gray-600">{{ $partner->address }}</p>
                                    </div>
                                </div>
                            @endif

                            @if($partner->phone)
                                <div class="flex items-center">
                                    <svg class="h-5 w-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                    </svg>
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">{{ __('Phone') }}</p>
                                        <a href="tel:{{ $partner->phone }}" class="text-sm text-blue-600 hover:text-blue-800">
                                            {{ $partner->phone }}
                                        </a>
                                    </div>
                                </div>
                            @endif

                            @if($partner->email)
                                <div class="flex items-center">
                                    <svg class="h-5 w-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">{{ __('Email') }}</p>
                                        <a href="mailto:{{ $partner->email }}" class="text-sm text-blue-600 hover:text-blue-800">
                                            {{ $partner->email }}
                                        </a>
                                    </div>
                                </div>
                            @endif

                            @if($partner->website)
                                <div class="flex items-center">
                                    <svg class="h-5 w-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9v-9m0-9v9"/>
                                    </svg>
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">{{ __('Website') }}</p>
                                        <a href="{{ $partner->website }}" target="_blank" class="text-sm text-blue-600 hover:text-blue-800">
                                            {{ __('Visit Website') }}
                                        </a>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="lg:col-span-1">
                    <div class="bg-blue-50 rounded-lg p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">{{ __('Quick Actions') }}</h3>
                        
                        @auth
                            <div class="space-y-3">
                                <a href="{{ route('bookings.create', ['partner' => $partner->id]) }}" 
                                   class="w-full inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    {{ __('Book Session') }}
                                </a>
                                
                                <button class="w-full inline-flex items-center justify-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    {{ __('Add to Favorites') }}
                                </button>
                            </div>
                        @else
                            <div class="text-center">
                                <p class="text-sm text-gray-600 mb-3">{{ __('Sign in to book sessions') }}</p>
                                <a href="{{ route('login') }}" 
                                   class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    {{ __('Sign In') }}
                                </a>
                            </div>
                        @endauth
                    </div>
                </div>
            </div>

            <!-- Courses Section (if implemented) -->
            @if(isset($partner->courses) && $partner->courses->count() > 0)
                <div class="mt-8 border-t border-gray-200 pt-8">
                    <h2 class="text-xl font-semibold text-gray-900 mb-4">{{ __('Available Courses') }}</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach($partner->courses as $course)
                            <div class="bg-white border border-gray-200 rounded-lg p-4">
                                <h3 class="font-semibold text-gray-900">{{ $course->title }}</h3>
                                <p class="text-sm text-gray-600 mt-1">{{ __('Coach') }}: {{ $course->coach }}</p>
                                <p class="text-sm text-gray-600">{{ __('Age Group') }}: {{ $course->age_group }}</p>
                                <p class="text-sm text-gray-600">{{ __('Schedule') }}: {{ $course->start_time->format('Y-m-d H:i') }} - {{ $course->end_time->format('Y-m-d H:i') }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
