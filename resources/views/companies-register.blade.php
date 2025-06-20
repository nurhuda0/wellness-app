@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto py-10">
    <div class="bg-white shadow rounded-lg p-8">
        <h2 class="text-2xl font-bold mb-6 text-center">Register Your Company</h2>
        <form method="POST" action="#">
            @csrf
            <div class="mb-4">
                <label for="company_name" class="block text-gray-700 font-semibold mb-2">Company Name</label>
                <input id="company_name" name="company_name" type="text" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" />
            </div>
            <div class="mb-4">
                <label for="hr_email" class="block text-gray-700 font-semibold mb-2">HR Contact Email</label>
                <input id="hr_email" name="hr_email" type="email" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" />
            </div>
            <div class="mb-4">
                <label for="password" class="block text-gray-700 font-semibold mb-2">Password</label>
                <input id="password" name="password" type="password" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" />
            </div>
            <div class="mb-6">
                <label for="password_confirmation" class="block text-gray-700 font-semibold mb-2">Confirm Password</label>
                <input id="password_confirmation" name="password_confirmation" type="password" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" />
            </div>
            <button type="submit" class="w-full px-4 py-2 bg-blue-600 text-white rounded-lg font-semibold shadow hover:bg-blue-700 transition">Register Company</button>
        </form>
        <div class="mt-6 text-center">
            <a href="/login" class="text-blue-600 hover:underline">Already registered? Login</a>
        </div>
    </div>
</div>
@endsection 