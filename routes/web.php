<?php

use App\Http\Controllers\Frontend\EventsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\Frontend\RentalsController;

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
        if (auth()->user()->hasRole('manager')) {
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

    Route::get('/cooptation', function () {
        return view('cooptation');
    })->name('cooptation');

    Route::post('/session', [StripeController::class, 'session'])->name('session');
    Route::get('/success', [StripeController::class, 'success'])->name('success');
    Route::get('/cancel', [StripeController::class, 'cancel'])->name('cancel');


    Route::prefix('cart')->group(function () {
        Route::get('/', [RentalsController::class, 'cart'])->name('cart');
        Route::patch('update', [RentalsController::class, 'update'])->name('update_cart');
        Route::delete('remove', [RentalsController::class, 'remove'])->name('remove_from_cart');

        // Rentals routes
        Route::prefix('rentals')->group(function () {
            Route::get('add-rental-to-cart/{id}', [RentalsController::class, 'addToCart'])->name('add_rental_to_cart');
        });

        // Events routes
        Route::prefix('events')->group(function () {
            Route::get('add-event-to-cart/{id}', [EventsController::class, 'addToCart'])->name('add_event_to_cart');
        });
    });

});

Route::middleware(['auth', 'management'])->name('management.')->prefix('management')->group(function () {
    Route::get('/', [\App\Http\Controllers\Management\ManagementController::class, 'index'])->name('index');
    Route::resource('/rentals', \App\Http\Controllers\Management\RentalsController::class);
    Route::resource('/events', \App\Http\Controllers\Management\EventsController::class);
});
