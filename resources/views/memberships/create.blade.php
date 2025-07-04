<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Membership Plan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('memberships.store') }}">
                        @csrf
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Basic Information -->
                            <div class="md:col-span-2">
                                <h3 class="text-lg font-semibold text-gray-900 mb-4">Basic Information</h3>
                            </div>

                            <div>
                                <x-input-label for="name" :value="__('Plan Name')" />
                                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" 
                                             :value="old('name')" required autofocus />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="price" :value="__('Price')" />
                                <x-text-input id="price" name="price" type="number" step="0.01" class="mt-1 block w-full" 
                                             :value="old('price')" required />
                                <x-input-error :messages="$errors->get('price')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="billing_cycle" :value="__('Billing Cycle')" />
                                <select id="billing_cycle" name="billing_cycle" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                    <option value="">Select billing cycle</option>
                                    @foreach($billingCycles as $value => $label)
                                        <option value="{{ $value }}" {{ old('billing_cycle') == $value ? 'selected' : '' }}>
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('billing_cycle')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="duration_days" :value="__('Duration (Days)')" />
                                <x-text-input id="duration_days" name="duration_days" type="number" class="mt-1 block w-full" 
                                             :value="old('duration_days')" required />
                                <x-input-error :messages="$errors->get('duration_days')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="max_bookings_per_month" :value="__('Max Bookings per Month')" />
                                <x-text-input id="max_bookings_per_month" name="max_bookings_per_month" type="number" class="mt-1 block w-full" 
                                             :value="old('max_bookings_per_month', 10)" required />
                                <x-input-error :messages="$errors->get('max_bookings_per_month')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="sort_order" :value="__('Sort Order')" />
                                <x-text-input id="sort_order" name="sort_order" type="number" class="mt-1 block w-full" 
                                             :value="old('sort_order', 0)" />
                                <x-input-error :messages="$errors->get('sort_order')" class="mt-2" />
                            </div>

                            <!-- Description -->
                            <div class="md:col-span-2">
                                <x-input-label for="description" :value="__('Description')" />
                                <textarea id="description" name="description" rows="3" 
                                          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                          placeholder="Describe the benefits of this membership plan...">{{ old('description') }}</textarea>
                                <x-input-error :messages="$errors->get('description')" class="mt-2" />
                            </div>

                            <!-- Features -->
                            <div class="md:col-span-2">
                                <x-input-label :value="__('Features')" />
                                <div class="mt-2 space-y-2">
                                    @foreach($defaultFeatures as $index => $feature)
                                        <div class="flex items-center">
                                            <input type="checkbox" id="feature_{{ $index }}" name="features[]" value="{{ $feature }}"
                                                   class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                                   {{ in_array($feature, old('features', [])) ? 'checked' : '' }}>
                                            <label for="feature_{{ $index }}" class="ml-2 text-sm text-gray-700">{{ $feature }}</label>
                                        </div>
                                    @endforeach
                                    
                                    <!-- Custom features -->
                                    <div class="mt-4">
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Custom Features</label>
                                        <div id="custom-features" class="space-y-2">
                                            <div class="flex">
                                                <input type="text" name="features[]" placeholder="Add custom feature..."
                                                       class="flex-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                                <button type="button" onclick="addCustomFeature()" 
                                                        class="ml-2 px-3 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                                                    Add
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <x-input-error :messages="$errors->get('features')" class="mt-2" />
                            </div>

                            <!-- Settings -->
                            <div class="md:col-span-2">
                                <h3 class="text-lg font-semibold text-gray-900 mb-4">Settings</h3>
                                <div class="space-y-4">
                                    <div class="flex items-center">
                                        <input type="checkbox" id="is_active" name="is_active" value="1"
                                               class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                               {{ old('is_active', true) ? 'checked' : '' }}>
                                        <label for="is_active" class="ml-2 text-sm text-gray-700">Active Plan</label>
                                    </div>

                                    <div class="flex items-center">
                                        <input type="checkbox" id="is_featured" name="is_featured" value="1"
                                               class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                               {{ old('is_featured') ? 'checked' : '' }}>
                                        <label for="is_featured" class="ml-2 text-sm text-gray-700">Featured Plan (Most Popular)</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <x-secondary-button type="button" onclick="window.history.back()" class="mr-3">
                                {{ __('Cancel') }}
                            </x-secondary-button>
                            <x-primary-button>
                                {{ __('Create Membership Plan') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function addCustomFeature() {
            const container = document.getElementById('custom-features');
            const newFeature = document.createElement('div');
            newFeature.className = 'flex';
            newFeature.innerHTML = `
                <input type="text" name="features[]" placeholder="Add custom feature..."
                       class="flex-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                <button type="button" onclick="this.parentElement.remove()" 
                        class="ml-2 px-3 py-2 bg-red-500 text-white rounded hover:bg-red-600">
                    Remove
                </button>
            `;
            container.appendChild(newFeature);
        }
    </script>
</x-app-layout>
