<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Booking') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('bookings.update', $booking) }}" id="bookingForm">
                        @csrf
                        @method('PUT')
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Partner Information (Read-only) -->
                            <div>
                                <x-input-label :value="__('Partner')" />
                                <div class="mt-1 p-3 bg-gray-50 rounded-md border border-gray-300">
                                    <p class="text-sm font-medium text-gray-900">{{ $booking->partner->name }}</p>
                                    <p class="text-sm text-gray-500">{{ ucfirst(str_replace('_', ' ', $booking->partner->type)) }} - {{ $booking->partner->city }}</p>
                                </div>
                            </div>

                            <!-- Current Booking Time (Read-only) -->
                            <div>
                                <x-input-label :value="__('Current Booking Time')" />
                                <div class="mt-1 p-3 bg-gray-50 rounded-md border border-gray-300">
                                    <p class="text-sm font-medium text-gray-900">{{ $booking->getFormattedBookingTime() }}</p>
                                    <p class="text-xs text-gray-500">{{ $booking->getTimeUntilBooking() }}</p>
                                </div>
                            </div>

                            <!-- New Date Selection -->
                            <div>
                                <x-input-label for="booking_date" :value="__('New Date')" />
                                <input type="date" id="booking_date" name="booking_date" required 
                                       min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                                       value="{{ $booking->booking_time->format('Y-m-d') }}"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <x-input-error :messages="$errors->get('booking_date')" class="mt-2" />
                            </div>

                            <!-- Time Slots -->
                            <div class="md:col-span-2">
                                <x-input-label :value="__('Available Time Slots')" />
                                <div id="timeSlots" class="mt-2 grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-2">
                                    <p class="text-gray-500 text-sm">Select a date to see available time slots</p>
                                </div>
                                <input type="hidden" id="booking_time" name="booking_time" required value="{{ $booking->booking_time->format('Y-m-d H:i:s') }}">
                                <x-input-error :messages="$errors->get('booking_time')" class="mt-2" />
                            </div>

                            <!-- Notes -->
                            <div class="md:col-span-2">
                                <x-input-label for="notes" :value="__('Notes (Optional)')" />
                                <textarea id="notes" name="notes" rows="3" 
                                          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                          placeholder="Any special requests or notes for your booking...">{{ old('notes', $booking->notes) }}</textarea>
                                <x-input-error :messages="$errors->get('notes')" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <x-secondary-button type="button" onclick="window.history.back()" class="mr-3">
                                {{ __('Cancel') }}
                            </x-secondary-button>
                            <x-primary-button>
                                {{ __('Update Booking') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const dateInput = document.getElementById('booking_date');
            const timeSlotsContainer = document.getElementById('timeSlots');
            const bookingTimeInput = document.getElementById('booking_time');
            const form = document.getElementById('bookingForm');
            const partnerId = {{ $booking->partner_id }};

            function loadTimeSlots() {
                const date = dateInput.value;

                if (!date) {
                    timeSlotsContainer.innerHTML = '<p class="text-gray-500 text-sm">Select a date to see available time slots</p>';
                    return;
                }

                timeSlotsContainer.innerHTML = '<p class="text-gray-500 text-sm">Loading available slots...</p>';

                fetch(`/bookings/slots/available?partner_id=${partnerId}&date=${date}`)
                    .then(response => response.json())
                    .then(slots => {
                        timeSlotsContainer.innerHTML = '';
                        
                        if (slots.length === 0) {
                            timeSlotsContainer.innerHTML = '<p class="text-red-500 text-sm">No available slots for this date</p>';
                            return;
                        }

                        slots.forEach(slot => {
                            const button = document.createElement('button');
                            button.type = 'button';
                            button.className = `p-3 text-sm font-medium rounded-md border transition-colors ${
                                slot.available 
                                    ? 'border-gray-300 text-gray-700 hover:bg-gray-50 focus:bg-indigo-50 focus:border-indigo-500 focus:text-indigo-700' 
                                    : 'border-gray-200 text-gray-400 bg-gray-50 cursor-not-allowed'
                            }`;
                            button.textContent = slot.time;
                            button.disabled = !slot.available;

                            // Check if this is the current booking time
                            const currentBookingTime = '{{ $booking->booking_time->format("H:i") }}';
                            if (slot.time === currentBookingTime) {
                                button.classList.add('bg-indigo-100', 'border-indigo-500', 'text-indigo-700');
                                button.classList.remove('border-gray-300', 'text-gray-700');
                            }

                            if (slot.available) {
                                button.addEventListener('click', function() {
                                    // Remove active class from all buttons
                                    document.querySelectorAll('#timeSlots button').forEach(btn => {
                                        btn.classList.remove('bg-indigo-100', 'border-indigo-500', 'text-indigo-700');
                                        btn.classList.add('border-gray-300', 'text-gray-700');
                                    });

                                    // Add active class to clicked button
                                    button.classList.remove('border-gray-300', 'text-gray-700');
                                    button.classList.add('bg-indigo-100', 'border-indigo-500', 'text-indigo-700');

                                    // Set the hidden input value
                                    bookingTimeInput.value = slot.datetime;
                                });
                            }

                            timeSlotsContainer.appendChild(button);
                        });
                    })
                    .catch(error => {
                        console.error('Error loading time slots:', error);
                        timeSlotsContainer.innerHTML = '<p class="text-red-500 text-sm">Error loading time slots</p>';
                    });
            }

            // Event listeners
            dateInput.addEventListener('change', loadTimeSlots);

            // Form validation
            form.addEventListener('submit', function(e) {
                if (!bookingTimeInput.value) {
                    e.preventDefault();
                    alert('Please select a time slot');
                    return false;
                }
            });

            // Load time slots on page load
            loadTimeSlots();
        });
    </script>
</x-app-layout> 