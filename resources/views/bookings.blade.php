@extends('layouts.app')

@section('content')
<div x-data="{ showModal: false, booking: null, showNewModal: false, newBooking: {partner: '', date: '', time: ''}, showSuccess: false }" class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
    <h2 class="text-2xl font-bold mb-6">{{ __('messages.bookings') }}</h2>
    <div class="mb-6">
        <button @click="showNewModal = true" class="inline-block px-6 py-3 bg-green-600 text-white rounded-lg font-semibold shadow hover:bg-green-700 transition">+ {{ __('messages.bookings') }}</button>
    </div>
    <template x-if="showSuccess">
        <div class="mb-6 p-4 bg-green-100 text-green-800 rounded shadow">{{ __('messages.booking_created') ?? 'Booking created successfully! (placeholder)' }}</div>
    </template>
    <div class="bg-white shadow rounded-lg overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('messages.partner') }}</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('messages.type') ?? 'Type' }}</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('messages.booking_time') }}</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('messages.status') }}</th>
                    <th class="px-6 py-3"></th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">Gym X</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ __('messages.gym') ?? 'Gym' }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">2024-06-18 10:00</td>
                    <td class="px-6 py-4 whitespace-nowrap"><span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">{{ __('messages.confirmed') ?? 'Confirmed' }}</span></td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium flex gap-2 justify-end">
                        <button @click="showModal = true; booking = {partner: 'Gym X', type: 'Gym', datetime: '2024-06-18 10:00', status: 'Confirmed', details: 'Personal training session with Coach Ali. Bring your membership card.'}" class="inline-block px-6 py-2 bg-green-600 text-white rounded-lg font-semibold shadow hover:bg-green-700 transition">{{ __('messages.view') ?? 'View' }}</button>
                        <a href="#" class="inline-block ml-2 px-6 py-2 bg-red-600 text-white rounded-lg font-semibold shadow hover:bg-red-700 transition">{{ __('messages.cancel') ?? 'Cancel' }}</a>
                    </td>
                </tr>
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">Spa Y</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ __('messages.spa') ?? 'Spa' }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">2024-06-20 15:00</td>
                    <td class="px-6 py-4 whitespace-nowrap"><span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">{{ __('messages.pending') ?? 'Pending' }}</span></td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium flex gap-2 justify-end">
                        <button @click="showModal = true; booking = {partner: 'Spa Y', type: 'Spa', datetime: '2024-06-20 15:00', status: 'Pending', details: 'Relaxing massage session. Please arrive 10 minutes early.'}" class="inline-block px-6 py-2 bg-green-600 text-white rounded-lg font-semibold shadow hover:bg-green-700 transition">{{ __('messages.view') ?? 'View' }}</button>
                        <a href="#" class="inline-block ml-2 px-6 py-2 bg-red-600 text-white rounded-lg font-semibold shadow hover:bg-red-700 transition">{{ __('messages.cancel') ?? 'Cancel' }}</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Booking Details Modal -->
    <div x-show="showModal" style="display: none;" class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-40">
        <div class="bg-white rounded-lg shadow-lg max-w-md w-full p-6 relative">
            <button @click="showModal = false" class="absolute top-2 right-2 text-gray-400 hover:text-gray-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
            <h3 class="text-xl font-bold mb-4">{{ __('messages.booking_details') ?? 'Booking Details' }}</h3>
            <template x-if="booking">
                <div>
                    <p><span class="font-semibold">{{ __('messages.partner') }}:</span> <span x-text="booking.partner"></span></p>
                    <p><span class="font-semibold">{{ __('messages.type') ?? 'Type' }}:</span> <span x-text="booking.type"></span></p>
                    <p><span class="font-semibold">{{ __('messages.booking_time') }}:</span> <span x-text="booking.datetime"></span></p>
                    <p><span class="font-semibold">{{ __('messages.status') }}:</span> <span x-text="booking.status"></span></p>
                    <p class="mt-2"><span class="font-semibold">{{ __('messages.details') ?? 'Details' }}:</span> <span x-text="booking.details"></span></p>
                </div>
            </template>
            <div class="mt-6 text-right">
                <button @click="showModal = false" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">{{ __('messages.close') ?? 'Close' }}</button>
            </div>
        </div>
    </div>

    <!-- New Booking Modal -->
    <div x-show="showNewModal" style="display: none;" class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-40">
        <div class="bg-white rounded-lg shadow-lg max-w-md w-full p-6 relative">
            <button @click="showNewModal = false" class="absolute top-2 right-2 text-gray-400 hover:text-gray-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
            <h3 class="text-xl font-bold mb-4">{{ __('messages.new_booking') ?? 'New Booking' }}</h3>
            <form @submit.prevent="showNewModal = false; showSuccess = true; setTimeout(() => showSuccess = false, 2000); newBooking = {partner: '', date: '', time: ''}">
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">{{ __('messages.partner') }}</label>
                    <select x-model="newBooking.partner" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">{{ __('messages.select_partner') ?? 'Select a partner' }}</option>
                        <option value="Gym X">Gym X</option>
                        <option value="Spa Y">Spa Y</option>
                        <option value="Sports Club Z">Sports Club Z</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">{{ __('messages.date') ?? 'Date' }}</label>
                    <input type="date" x-model="newBooking.date" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" />
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">{{ __('messages.time') ?? 'Time' }}</label>
                    <input type="time" x-model="newBooking.time" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" />
                </div>
                <div class="flex justify-end gap-2">
                    <button type="button" @click="showNewModal = false" class="px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400">{{ __('messages.cancel') ?? 'Cancel' }}</button>
                    <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">{{ __('messages.book') ?? 'Book' }}</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Simple Calendar UI -->
    <div x-data="calendar()" class="mt-10 bg-white shadow rounded-lg p-6">
        <div class="flex items-center justify-between mb-4">
            <button @click="prevMonth" class="px-2 py-1 bg-gray-200 rounded hover:bg-gray-300">&lt;</button>
            <div class="text-lg font-semibold" x-text="monthYear"></div>
            <button @click="nextMonth" class="px-2 py-1 bg-gray-200 rounded hover:bg-gray-300">&gt;</button>
        </div>
        <div class="grid grid-cols-7 gap-2 text-center text-gray-600 mb-2">
            <template x-for="day in days" :key="day">
                <div class="font-bold"><span x-text="day"></span></div>
            </template>
        </div>
        <div class="grid grid-cols-7 gap-2 text-center">
            <template x-for="blank in blanks" :key="'b'+blank">
                <div></div>
            </template>
            <template x-for="date in datesInMonth" :key="date">
                <button @click="selectDate(date)"
                    :class="{
                        'bg-blue-600 text-white': isSelected(date),
                        'bg-green-100 text-green-800 font-bold': isToday(date),
                        'bg-gray-100': !isSelected(date) && !isToday(date)
                    }"
                    class="w-10 h-10 rounded-full focus:outline-none">
                    <span x-text="date"></span>
                </button>
            </template>
        </div>
        <div class="mt-4 text-center" x-show="selected">
            <span class="font-semibold">{{ __('messages.selected_date') ?? 'Selected date:' }}</span> <span x-text="selected"></span>
        </div>
    </div>

    <script>
    function calendar() {
        const today = new Date();
        return {
            month: today.getMonth(),
            year: today.getFullYear(),
            selected: null,
            days: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
            get monthYear() {
                return new Date(this.year, this.month).toLocaleString('default', { month: 'long', year: 'numeric' });
            },
            get datesInMonth() {
                return Array.from({length: new Date(this.year, this.month + 1, 0).getDate()}, (_, i) => i + 1);
            },
            get blanks() {
                return Array.from({length: new Date(this.year, this.month, 1).getDay()}, (_, i) => i);
            },
            isToday(date) {
                return date === today.getDate() && this.month === today.getMonth() && this.year === today.getFullYear();
            },
            isSelected(date) {
                return this.selected && date === this.selected.getDate() && this.month === this.selected.getMonth() && this.year === this.selected.getFullYear();
            },
            selectDate(date) {
                this.selected = new Date(this.year, this.month, date);
            },
            prevMonth() {
                if (this.month === 0) {
                    this.month = 11; this.year--;
                } else {
                    this.month--;
                }
            },
            nextMonth() {
                if (this.month === 11) {
                    this.month = 0; this.year++;
                } else {
                    this.month++;
                }
            }
        }
    }
    </script>
</div>
@endsection 