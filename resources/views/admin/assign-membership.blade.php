@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
    <h2 class="text-2xl font-bold mb-6">Assign Membership Plan</h2>
    <div class="bg-white shadow rounded-lg overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Current Plan</th>
                    <th class="px-6 py-3"></th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">Alice Smith</td>
                    <td class="px-6 py-4 whitespace-nowrap">alice@company.com</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <select class="border rounded px-2 py-1">
                            <option selected>Gold</option>
                            <option>Silver</option>
                            <option>Bronze</option>
                        </select>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <button class="text-blue-600 hover:underline">Save</button>
                    </td>
                </tr>
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">Bob Lee</td>
                    <td class="px-6 py-4 whitespace-nowrap">bob@company.com</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <select class="border rounded px-2 py-1">
                            <option>Gold</option>
                            <option selected>Silver</option>
                            <option>Bronze</option>
                        </select>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <button class="text-blue-600 hover:underline">Save</button>
                    </td>
                </tr>
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">Carol King</td>
                    <td class="px-6 py-4 whitespace-nowrap">carol@company.com</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <select class="border rounded px-2 py-1">
                            <option>Gold</option>
                            <option>Silver</option>
                            <option selected>Bronze</option>
                        </select>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <button class="text-blue-600 hover:underline">Save</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection 