<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('System Settings') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form method="POST" action="{{ route('admin.settings.update') }}" class="space-y-6">
                        @csrf
                        
                        <!-- General Settings -->
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">General Settings</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <x-input-label for="app_name" :value="__('Application Name')" />
                                    <x-text-input id="app_name" name="app_name" type="text" class="mt-1 block w-full" 
                                                 :value="old('app_name', config('app.name'))" required />
                                    <x-input-error :messages="$errors->get('app_name')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="max_bookings_per_user" :value="__('Max Bookings per User')" />
                                    <x-text-input id="max_bookings_per_user" name="max_bookings_per_user" type="number" class="mt-1 block w-full" 
                                                 :value="old('max_bookings_per_user', 10)" required />
                                    <x-input-error :messages="$errors->get('max_bookings_per_user')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="booking_advance_days" :value="__('Booking Advance Days')" />
                                    <x-text-input id="booking_advance_days" name="booking_advance_days" type="number" class="mt-1 block w-full" 
                                                 :value="old('booking_advance_days', 30)" required />
                                    <x-input-error :messages="$errors->get('booking_advance_days')" class="mt-2" />
                                </div>

                                <div class="flex items-center">
                                    <input type="checkbox" id="maintenance_mode" name="maintenance_mode" value="1"
                                           class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                           {{ old('maintenance_mode') ? 'checked' : '' }}>
                                    <label for="maintenance_mode" class="ml-2 text-sm text-gray-700">Maintenance Mode</label>
                                </div>
                            </div>
                        </div>

                        <!-- Email Settings -->
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Email Settings</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <x-input-label for="mail_from_address" :value="__('From Email Address')" />
                                    <x-text-input id="mail_from_address" name="mail_from_address" type="email" class="mt-1 block w-full" 
                                                 :value="old('mail_from_address', config('mail.from.address'))" />
                                    <x-input-error :messages="$errors->get('mail_from_address')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="mail_from_name" :value="__('From Name')" />
                                    <x-text-input id="mail_from_name" name="mail_from_name" type="text" class="mt-1 block w-full" 
                                                 :value="old('mail_from_name', config('mail.from.name'))" />
                                    <x-input-error :messages="$errors->get('mail_from_name')" class="mt-2" />
                                </div>
                            </div>
                        </div>

                        <!-- Booking Settings -->
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Booking Settings</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <x-input-label for="booking_time_slot" :value="__('Time Slot Duration (minutes)')" />
                                    <x-text-input id="booking_time_slot" name="booking_time_slot" type="number" class="mt-1 block w-full" 
                                                 :value="old('booking_time_slot', 60)" />
                                    <x-input-error :messages="$errors->get('booking_time_slot')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="cancellation_hours" :value="__('Cancellation Notice (hours)')" />
                                    <x-text-input id="cancellation_hours" name="cancellation_hours" type="number" class="mt-1 block w-full" 
                                                 :value="old('cancellation_hours', 24)" />
                                    <x-input-error :messages="$errors->get('cancellation_hours')" class="mt-2" />
                                </div>

                                <div class="flex items-center">
                                    <input type="checkbox" id="auto_confirm_bookings" name="auto_confirm_bookings" value="1"
                                           class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                           {{ old('auto_confirm_bookings') ? 'checked' : '' }}>
                                    <label for="auto_confirm_bookings" class="ml-2 text-sm text-gray-700">Auto-confirm bookings</label>
                                </div>

                                <div class="flex items-center">
                                    <input type="checkbox" id="send_booking_reminders" name="send_booking_reminders" value="1"
                                           class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                           {{ old('send_booking_reminders', true) ? 'checked' : '' }}>
                                    <label for="send_booking_reminders" class="ml-2 text-sm text-gray-700">Send booking reminders</label>
                                </div>
                            </div>
                        </div>

                        <!-- Security Settings -->
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Security Settings</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <x-input-label for="session_timeout" :value="__('Session Timeout (minutes)')" />
                                    <x-text-input id="session_timeout" name="session_timeout" type="number" class="mt-1 block w-full" 
                                                 :value="old('session_timeout', 120)" />
                                    <x-input-error :messages="$errors->get('session_timeout')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="max_login_attempts" :value="__('Max Login Attempts')" />
                                    <x-text-input id="max_login_attempts" name="max_login_attempts" type="number" class="mt-1 block w-full" 
                                                 :value="old('max_login_attempts', 5)" />
                                    <x-input-error :messages="$errors->get('max_login_attempts')" class="mt-2" />
                                </div>

                                <div class="flex items-center">
                                    <input type="checkbox" id="require_email_verification" name="require_email_verification" value="1"
                                           class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                           {{ old('require_email_verification', true) ? 'checked' : '' }}>
                                    <label for="require_email_verification" class="ml-2 text-sm text-gray-700">Require email verification</label>
                                </div>

                                <div class="flex items-center">
                                    <input type="checkbox" id="enable_two_factor" name="enable_two_factor" value="1"
                                           class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                           {{ old('enable_two_factor') ? 'checked' : '' }}>
                                    <label for="enable_two_factor" class="ml-2 text-sm text-gray-700">Enable two-factor authentication</label>
                                </div>
                            </div>
                        </div>

                        <!-- Notification Settings -->
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Notification Settings</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="flex items-center">
                                    <input type="checkbox" id="notify_new_bookings" name="notify_new_bookings" value="1"
                                           class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                           {{ old('notify_new_bookings', true) ? 'checked' : '' }}>
                                    <label for="notify_new_bookings" class="ml-2 text-sm text-gray-700">Notify on new bookings</label>
                                </div>

                                <div class="flex items-center">
                                    <input type="checkbox" id="notify_booking_cancellations" name="notify_booking_cancellations" value="1"
                                           class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                           {{ old('notify_booking_cancellations', true) ? 'checked' : '' }}>
                                    <label for="notify_booking_cancellations" class="ml-2 text-sm text-gray-700">Notify on booking cancellations</label>
                                </div>

                                <div class="flex items-center">
                                    <input type="checkbox" id="notify_new_users" name="notify_new_users" value="1"
                                           class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                           {{ old('notify_new_users', true) ? 'checked' : '' }}>
                                    <label for="notify_new_users" class="ml-2 text-sm text-gray-700">Notify on new user registrations</label>
                                </div>

                                <div class="flex items-center">
                                    <input type="checkbox" id="notify_system_alerts" name="notify_system_alerts" value="1"
                                           class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                           {{ old('notify_system_alerts', true) ? 'checked' : '' }}>
                                    <label for="notify_system_alerts" class="ml-2 text-sm text-gray-700">Notify on system alerts</label>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <x-secondary-button type="button" onclick="window.history.back()" class="mr-3">
                                {{ __('Cancel') }}
                            </x-secondary-button>
                            <x-primary-button>
                                {{ __('Save Settings') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 