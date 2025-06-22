<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Booking Calendar') }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('bookings.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    List View
                </a>
                <a href="{{ route('bookings.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    New Booking
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <!-- Calendar Navigation -->
                    <div class="flex items-center justify-between mb-6">
                        @php
                            $currentMonth = \Carbon\Carbon::parse($month);
                            $prevMonth = $currentMonth->copy()->subMonth();
                            $nextMonth = $currentMonth->copy()->addMonth();
                        @endphp
                        
                        <a href="{{ route('bookings.calendar', ['month' => $prevMonth->format('Y-m')]) }}" 
                           class="flex items-center text-gray-600 hover:text-gray-900">
                            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                            </svg>
                            {{ $prevMonth->format('F Y') }}
                        </a>
                        
                        <h3 class="text-lg font-semibold text-gray-900">
                            {{ $currentMonth->format('F Y') }}
                        </h3>
                        
                        <a href="{{ route('bookings.calendar', ['month' => $nextMonth->format('Y-m')]) }}" 
                           class="flex items-center text-gray-600 hover:text-gray-900">
                            {{ $nextMonth->format('F Y') }}
                            <svg class="w-5 h-5 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>

                    <!-- Calendar Grid -->
                    <div class="grid grid-cols-7 gap-px bg-gray-200 border border-gray-200 rounded-lg overflow-hidden">
                        <!-- Day Headers -->
                        <div class="bg-gray-50 p-2 text-center text-sm font-medium text-gray-700">Sun</div>
                        <div class="bg-gray-50 p-2 text-center text-sm font-medium text-gray-700">Mon</div>
                        <div class="bg-gray-50 p-2 text-center text-sm font-medium text-gray-700">Tue</div>
                        <div class="bg-gray-50 p-2 text-center text-sm font-medium text-gray-700">Wed</div>
                        <div class="bg-gray-50 p-2 text-center text-sm font-medium text-gray-700">Thu</div>
                        <div class="bg-gray-50 p-2 text-center text-sm font-medium text-gray-700">Fri</div>
                        <div class="bg-gray-50 p-2 text-center text-sm font-medium text-gray-700">Sat</div>

                        <!-- Calendar Days -->
                        @php
                            $startOfMonth = $currentMonth->copy()->startOfMonth();
                            $endOfMonth = $currentMonth->copy()->endOfMonth();
                            $startOfWeek = $startOfMonth->copy()->startOfWeek();
                            $endOfWeek = $endOfMonth->copy()->endOfWeek();
                            $currentDate = $startOfWeek->copy();
                        @endphp

                        @while($currentDate <= $endOfWeek)
                            @php
                                $isCurrentMonth = $currentDate->month === $currentMonth->month;
                                $isToday = $currentDate->isToday();
                                $dayBookings = $bookings->get($currentDate->format('Y-m-d'), collect());
                                $dayKey = $currentDate->format('Y-m-d');
                            @endphp

                            <div class="bg-white min-h-[120px] p-2 {{ !$isCurrentMonth ? 'bg-gray-50' : '' }} {{ $isToday ? 'ring-2 ring-blue-500' : '' }}">
                                <div class="flex justify-between items-start">
                                    <span class="text-sm font-medium {{ $isCurrentMonth ? 'text-gray-900' : 'text-gray-400' }} {{ $isToday ? 'text-blue-600' : '' }}">
                                        {{ $currentDate->day }}
                                    </span>
                                    @if($isToday)
                                        <span class="text-xs text-blue-600 font-medium">Today</span>
                                    @endif
                                </div>

                                <!-- Bookings for this day -->
                                <div class="mt-1 space-y-1">
                                    @foreach($dayBookings as $booking)
                                        @php
                                            $statusColors = [
                                                'pending' => 'bg-yellow-100 text-yellow-800 border-yellow-200',
                                                'confirmed' => 'bg-green-100 text-green-800 border-green-200',
                                                'cancelled' => 'bg-red-100 text-red-800 border-red-200',
                                                'completed' => 'bg-blue-100 text-blue-800 border-blue-200',
                                            ];
                                            $color = $statusColors[$booking->status] ?? 'bg-gray-100 text-gray-800 border-gray-200';
                                        @endphp
                                        
                                        <a href="{{ route('bookings.show', $booking) }}" 
                                           class="block text-xs p-1 rounded border {{ $color }} hover:opacity-75 transition-opacity">
                                            <div class="font-medium truncate">{{ $booking->partner->name }}</div>
                                            <div class="text-xs opacity-75">{{ $booking->booking_time->format('g:i A') }}</div>
                                        </a>
                                    @endforeach
                                </div>

                                <!-- Add booking button for current month -->
                                @if($isCurrentMonth && $currentDate->isFuture())
                                    <div class="mt-1">
                                        <a href="{{ route('bookings.create', ['partner_id' => '', 'date' => $currentDate->format('Y-m-d')]) }}" 
                                           class="block text-xs text-blue-600 hover:text-blue-800 text-center py-1 rounded hover:bg-blue-50">
                                            + Add
                                        </a>
                                    </div>
                                @endif
                            </div>

                            @php
                                $currentDate->addDay();
                            @endphp
                        @endwhile
                    </div>

                    <!-- Legend -->
                    <div class="mt-6 flex flex-wrap gap-4 text-sm">
                        <div class="flex items-center">
                            <div class="w-3 h-3 bg-yellow-100 border border-yellow-200 rounded mr-2"></div>
                            <span>Pending</span>
                        </div>
                        <div class="flex items-center">
                            <div class="w-3 h-3 bg-green-100 border border-green-200 rounded mr-2"></div>
                            <span>Confirmed</span>
                        </div>
                        <div class="flex items-center">
                            <div class="w-3 h-3 bg-blue-100 border border-blue-200 rounded mr-2"></div>
                            <span>Completed</span>
                        </div>
                        <div class="flex items-center">
                            <div class="w-3 h-3 bg-red-100 border border-red-200 rounded mr-2"></div>
                            <span>Cancelled</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 