<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PartnerController;
use App\Http\Controllers\Api\BookingController;

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

// Authentication
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

// Partners
Route::get('/partners', [PartnerController::class, 'index']);

// Bookings (protected)
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/booking', [BookingController::class, 'store']);
    Route::delete('/booking/{id}', [BookingController::class, 'destroy']);
    Route::get('/my-bookings', [BookingController::class, 'myBookings']);
});
