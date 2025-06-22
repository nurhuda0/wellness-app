<?php

use App\Http\Controllers\PartnerController;
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
Route::get('/partners', [PartnerController::class, 'apiIndex']);

// Booking API Routes
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/booking', function (Request $request) {
        // TODO: Implement booking creation
        return response()->json(['message' => 'Booking endpoint - to be implemented'], 501);
    });

    Route::delete('/booking/{id}', function ($id) {
        // TODO: Implement booking cancellation
        return response()->json(['message' => 'Booking cancellation - to be implemented'], 501);
    });

    Route::get('/my-bookings', function () {
        // TODO: Implement user bookings list
        return response()->json(['message' => 'My bookings - to be implemented'], 501);
    });
});
