@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
    <h2 class="text-2xl font-bold mb-6">Partner Management</h2>
    <div class="mb-4">
        <button class="px-6 py-2 bg-green-600 text-white rounded-lg font-semibold shadow hover:bg-green-700 transition">+ Add Partner</button>
    </div>
    <div class="bg-white shadow rounded-lg overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">City</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3"></th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">Gym X</td>
                    <td class="px-6 py-4 whitespace-nowrap">Gym</td>
                    <td class="px-6 py-4 whitespace-nowrap">Riyadh</td>
                    <td class="px-6 py-4 whitespace-nowrap">Active</td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <button class="text-blue-600 hover:underline mr-2">Edit</button>
                        <button class="text-red-600 hover:underline">Delete</button>
                    </td>
                </tr>
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">Spa Y</td>
                    <td class="px-6 py-4 whitespace-nowrap">Spa</td>
                    <td class="px-6 py-4 whitespace-nowrap">Jeddah</td>
                    <td class="px-6 py-4 whitespace-nowrap">Pending</td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <button class="text-blue-600 hover:underline mr-2">Edit</button>
                        <button class="text-red-600 hover:underline">Delete</button>
                    </td>
                </tr>
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">Sports Club Z</td>
                    <td class="px-6 py-4 whitespace-nowrap">Sports Club</td>
                    <td class="px-6 py-4 whitespace-nowrap">Dammam</td>
                    <td class="px-6 py-4 whitespace-nowrap">Suspended</td>
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