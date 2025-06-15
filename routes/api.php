<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Partner API Routes
Route::get('/partners', function (Request $request) {
    $partners = Partner::query()
        ->when($request->city, function ($query) use ($request) {
            $query->where('city', $request->city);
        })
        ->when($request->type, function ($query) use ($request) {
            $query->where('type', $request->type);
        })
        ->get();

    return response()->json($partners);
});

// Booking API Routes
Route::post('/booking', function (Request $request) {
    $validated = $request->validate([
        'partner_id' => 'required|exists:partners,id',
        'booking_time' => 'required|date',
    ]);

    Booking::create([
        'user_id' => auth()->id(),
        'partner_id' => $validated['partner_id'],
        'booking_time' => $validated['booking_time'],
        'status' => 'pending'
    ]);

    return response()->json(['message' => 'Booking created successfully'], 201);
});

Route::delete('/booking/{id}', function (Booking $booking) {
    $booking->delete();
    return response()->json(['message' => 'Booking cancelled successfully']);
});

Route::get('/my-bookings', function () {
    return response()->json(
        auth()->user()->bookings()
            ->with('partner')
            ->get()
    );
});
