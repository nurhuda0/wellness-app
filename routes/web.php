<?php

use App\Http\Controllers\ProfileController;
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
    return view('bookings');
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

Route::get('/admin/users', function () {
    return view('admin.users');
})->name('admin.users');

Route::get('/admin/companies', function () {
    return view('admin.companies');
})->name('admin.companies');

Route::get('/admin/memberships', function () {
    return view('admin.memberships');
})->name('admin.memberships');

Route::get('/admin/bookings', function () {
    return view('admin.bookings');
})->name('admin.bookings');

Route::get('/admin/partners', function () {
    return view('admin.partners');
})->name('admin.partners');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/assign-membership', function () {
        return view('admin.assign-membership');
    })->name('admin.assign-membership');
    Route::get('/admin/assign-role', function () {
        return view('admin.assign-role');
    })->name('admin.assign-role');
});

Route::post('/companies/register', [\App\Http\Controllers\CompanyController::class, 'store'])->name('companies.register.store');

require __DIR__.'/auth.php';
