<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/partners', [\App\Http\Controllers\PartnerController::class, 'index'])->name('partners.index');
Route::get('/partners/{partner}', [\App\Http\Controllers\PartnerController::class, 'show'])->name('partners.show');

Route::get('/bookings', function () {
    return redirect()->route('bookings.index');
})->middleware(['auth']);

Route::get('/companies/register', function () {
    return view('companies-register');
})->name('companies.register');

Route::post('/lang/{lang}', function ($lang) {
    if (!in_array($lang, ['en', 'ar'])) {
        abort(400);
    }
    App::setLocale($lang);
    session(['locale' => $lang, 'rtl' => $lang === 'ar']);
    return back();
});

// Admin routes using AdminController
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::get('/companies', [AdminController::class, 'companies'])->name('companies');
    Route::get('/memberships', [AdminController::class, 'memberships'])->name('memberships');
    Route::get('/bookings', [AdminController::class, 'bookings'])->name('bookings');
    Route::get('/partners', [AdminController::class, 'partners'])->name('partners');
    Route::get('/settings', [AdminController::class, 'settings'])->name('settings');
    Route::post('/settings', [AdminController::class, 'updateSettings'])->name('settings.update');
    Route::get('/export', [AdminController::class, 'export'])->name('export');
    
    // Legacy routes for backward compatibility
    Route::get('/assign-membership', function () {
        return view('admin.assign-membership');
    })->name('assign-membership');
    Route::get('/assign-role', function () {
        return view('admin.assign-role');
    })->name('assign-role');
});

Route::post('/companies/register', [\App\Http\Controllers\CompanyController::class, 'store'])->name('companies.register.store');

// Booking routes
Route::middleware(['auth'])->group(function () {
    Route::resource('bookings', \App\Http\Controllers\BookingController::class);
    Route::get('/bookings/calendar', [\App\Http\Controllers\BookingController::class, 'calendar'])->name('bookings.calendar');
    Route::get('/bookings/slots/available', [\App\Http\Controllers\BookingController::class, 'getAvailableSlots'])->name('bookings.slots.available');
});

// API routes for bookings
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/api/bookings', [\App\Http\Controllers\BookingController::class, 'apiIndex'])->name('api.bookings.index');
    Route::post('/api/bookings', [\App\Http\Controllers\BookingController::class, 'apiStore'])->name('api.bookings.store');
});

require __DIR__.'/auth.php';
