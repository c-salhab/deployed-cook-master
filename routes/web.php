<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\Frontend\RentalsController;
use App\Http\Controllers\Provider\ProviderController;
use App\Http\Controllers\Provider\PDFController;

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

Route::get('/', function () { return view('welcome'); })->name('welcome');

Route::get('/aboutus', function () { return view('aboutus'); })->name('aboutus');

Route::get('/terms', function () { return view('terms'); })->name('terms');

Route::middleware([ 'auth:sanctum', config('jetstream.auth_session'), 'verified' ])->group(function () {

    Route::get('/dashboard', function () { $user = auth()->user(); $canManage = $user->hasRole('manager');
        return view('dashboard', compact('canManage'));
    })->name('dashboard');

    Route::get('/subscription', function () { return view('subscription'); })->name('subscription');

    Route::get('/message', function () { return view('message'); })->name('message');

    Route::get('/recipes', function () { return view('recipes'); })->name('recipes');

    Route::get('/interventions', function () { return view('interventions'); })->name('interventions');

    Route::get('/shop', function () { return view('shop'); })->name('shop');

    Route::get('/events', [\App\Http\Controllers\Frontend\EventsController::class, 'index'])->name('events.index');
    Route::get('/lessons', [\App\Http\Controllers\Frontend\LessonsController::class, 'index'])->name('lessons.index');
    Route::get('/certified_courses', [\App\Http\Controllers\Frontend\FormationsController::class, 'index'])->name('formations.index');

    Route::get('/cooptation', function () { return view('cooptation'); })->name('cooptation');

    Route::post('/session', [StripeController::class, 'session'])->name('session');
    Route::get('/success', [StripeController::class, 'success'])->name('success');
    Route::get('/cancel', [StripeController::class, 'cancel'])->name('cancel');


    Route::prefix('cart')->group(function () {

        Route::get('/', [RentalsController::class, 'cart'])->name('cart');

        Route::patch('update', [RentalsController::class, 'update'])->name('update_cart');

        Route::delete('remove', [RentalsController::class, 'remove'])->name('remove_from_cart');

        Route::prefix('rentals')->group(function () {
            Route::get('add-rental-to-cart/{id}', [RentalsController::class, 'addToCart'])->name('add_rental_to_cart');
        });

        Route::prefix('events')->group(function () {
            Route::get('add-event-to-cart/{id}', [App\Http\Controllers\Frontend\EventsController::class, 'addToCart'])->name('add_event_to_cart');
        });

        Route::prefix('certified_courses')->group(function () {
            Route::get('add-formations-to-cart/{id}', [App\Http\Controllers\Frontend\FormationsController::class, 'addToCart'])->name('add_formation_to_cart');
        });

        Route::prefix('lessons')->group(function () {
            Route::get('add-lessons-to-cart/{id}', [App\Http\Controllers\Frontend\LessonsController::class, 'addToCart'])->name('add_lesson_to_cart');
        });
    });

});

Route::middleware(['auth', 'management'])->name('management.')->prefix('management')->group(function () {

    Route::get('/events/step-one', [\App\Http\Controllers\Steps\EventsController::class, 'stepOne'])->name('events.step-one');
    Route::post('/events/step-one', [\App\Http\Controllers\Steps\EventsController::class, 'storeStepOne'])->name('events.store.step-one');
    Route::get('/events/step-two', [\App\Http\Controllers\Steps\EventsController::class, 'stepTwo'])->name('events.step-two');
    Route::post('/events/step-two', [\App\Http\Controllers\Steps\EventsController::class, 'storeStepTwo'])->name('events.store.step-two');
    Route::get('/events/step-three', [\App\Http\Controllers\Steps\EventsController::class, 'stepThree'])->name('events.step-three');
    Route::post('/events/step-three', [\App\Http\Controllers\Steps\EventsController::class, 'storeStepThree'])->name('events.store.step-three');
    Route::get('/', [\App\Http\Controllers\Management\ManagementController::class, 'index'])->name('index');

    Route::resource('/rentals', \App\Http\Controllers\Management\RentalsController::class);
    Route::resource('/formations', \App\Http\Controllers\Management\FormationsController::class);
    Route::resource('/materials', \App\Http\Controllers\Management\MaterialsController::class);
    Route::resource('/rooms', \App\Http\Controllers\Management\RoomsController::class);
    Route::resource('/events', \App\Http\Controllers\Management\EventsController::class);
    Route::resource('/lessons', \App\Http\Controllers\Management\LessonsController::class);
    Route::resource('/products', \App\Http\Controllers\Management\ProductsController::class);
    Route::resource('/associations', \App\Http\Controllers\Management\AssociationsController::class);
    Route::resource('/recipes', \App\Http\Controllers\Management\RecipesController::class);

    Route::post('/search-events-materials', '\App\Http\Controllers\Management\EventsController@search_1')->name('events.search_1');
    Route::post('/search-events', '\App\Http\Controllers\Management\EventsController@search_2')->name('events.search_2');
    Route::post('/search-rooms', '\App\Http\Controllers\Management\RoomsController@search')->name('rooms.search');
    Route::post('/search-materials', '\App\Http\Controllers\Management\MaterialsController@search')->name('materials.search');
    Route::post('/search-formations', '\App\Http\Controllers\Management\FormationsController@search')->name('formations.search');
    Route::post('/search-lessons', '\App\Http\Controllers\Management\LessonsController@search')->name('lessons.search');
    Route::post('/search-products', '\App\Http\Controllers\Management\ProductsController@search')->name('products.search');
    Route::post('/search-recipes', '\App\Http\Controllers\Management\RecipesController@search')->name('recipes.search');
});


Route::middleware(['auth', 'provider'])->name('provider.')->prefix('provider')->group(function () {
    Route::get('/', [ProviderController::class, 'index'])->name('index');
    Route::resource('/courses', \App\Http\Controllers\Provider\CoursesController::class);
    Route::resource('/students', \App\Http\Controllers\Provider\StudentsController::class);
    Route::resource('/certifications', \App\Http\Controllers\Provider\CertificationsController::class);
    Route::post('/search-certifications', '\App\Http\Controllers\Provider\CertificationsController@search')->name('certifications.search');
    Route::post('/search-courses', '\App\Http\Controllers\Provider\CoursesController@search')->name('courses.search');
    Route::post('/search-students', '\App\Http\Controllers\Provider\StudentsController@search')->name('students.search');
    Route::post('/generate-pdf/{certificationId}', [PDFController::class, 'generatePDF'])->name('certifications.generate-pdf');

});

