<?php

use Illuminate\Support\Facades\Route;

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
})->name('welcome');

Route::get('/aboutus', function () {
    return view('aboutus');
})->name('aboutus');

Route::get('/terms', function () {
    return view('terms');
})->name('terms');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        if (auth()->user()->is_admin) {
            return view('dashboard')->with('canManage', true);
        } else {
            return view('dashboard')->with('canManage', false);
        }
    })->name('dashboard');

    Route::get('/subscription', function () {
        return view('subscription');
    })->name('subscription');

    Route::get('/message', function () {
        return view('message');
    })->name('message');

    Route::get('/lessons', function () {
        return view('lessons');
    })->name('lessons');

    Route::get('/certified_courses', function () {
        return view('certified_courses');
    })->name('certified_courses');

    Route::get('/recipes', function () {
        return view('recipes');
    })->name('recipes');

    Route::get('/interventions', function () {
        return view('interventions');
    })->name('interventions');

    Route::get('/shop', function () {
        return view('shop');
    })->name('shop');

    Route::get('/rentals', [\App\Http\Controllers\Frontend\RentalsController::class, 'index'])->name('rentals.index');
    Route::get('/rentals/{rental}', [\App\Http\Controllers\Frontend\RentalsController::class, 'show'])->name('rentals.show');

    Route::get('/events', [\App\Http\Controllers\Frontend\EventsController::class, 'index'])->name('events.index');
    Route::get('/events/{event}', [\App\Http\Controllers\Frontend\EventsController::class, 'show'])->name('events.show');

    Route::get('/cooptation', function () {
        return view('cooptation');
    })->name('cooptation');
});

Route::middleware(['auth', 'management'])->name('management.')->prefix('management')->group(function () {
    Route::get('/', [\App\Http\Controllers\Management\ManagementController::class, 'index'])->name('index');
    Route::resource('/rentals', \App\Http\Controllers\Management\RentalsController::class);
    Route::resource('/events', \App\Http\Controllers\Management\EventsController::class);
});

