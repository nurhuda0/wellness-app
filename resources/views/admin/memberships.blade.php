@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
    <h2 class="text-2xl font-bold mb-6">Membership Management</h2>
    <div class="bg-white shadow rounded-lg overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Plan Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Features</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                    <th class="px-6 py-3"></th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">Gold</td>
                    <td class="px-6 py-4 whitespace-nowrap">Unlimited access, Free classes, VIP support</td>
                    <td class="px-6 py-4 whitespace-nowrap">$99/mo</td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <button class="text-blue-600 hover:underline mr-2">Edit</button>
                        <button class="text-red-600 hover:underline">Delete</button>
                    </td>
                </tr>
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">Silver</td>
                    <td class="px-6 py-4 whitespace-nowrap">Access to gym & pool, 5 classes/mo</td>
                    <td class="px-6 py-4 whitespace-nowrap">$59/mo</td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <button class="text-blue-600 hover:underline mr-2">Edit</button>
                        <button class="text-red-600 hover:underline">Delete</button>
                    </td>
                </tr>
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">Bronze</td>
                    <td class="px-6 py-4 whitespace-nowrap">Gym access only</td>
                    <td class="px-6 py-4 whitespace-nowrap">$29/mo</td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <button class="text-blue-600 hover:underline mr-2">Edit</button>
                        <button class="text-red-600 hover:underline">Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection 