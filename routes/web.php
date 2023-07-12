<?php

use App\Http\Controllers\SubscriptionController;
use App\Http\Livewire\Administration\Coupons\Coupon;
use App\Http\Livewire\Administration\Coupons\CreateCoupon;
use App\Http\Livewire\Administration\Coupons\ShowCodes;
use App\Http\Livewire\Cart\Cart;
use App\Http\Livewire\Lessons\LessonPage;
use App\Http\Livewire\Lessons\LessonPreview;
use App\Http\Livewire\Lessons\LessonsShop;
use App\Http\Livewire\Provider\Classes\CreateClass;
use App\Http\Livewire\Provider\Classes\ShowClasses;
use App\Http\Livewire\Provider\Lessons\CreateLesson;
use App\Http\Livewire\Provider\Lessons\ShowLessons;
use App\Http\Livewire\Users\BillingDashboard;
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

Route::get('/', function () { return view('welcome'); })->name('welcome');

Route::get('/aboutus', function () { return view('aboutus'); })->name('aboutus');

Route::get('/terms', function () { return view('terms'); })->name('terms');

Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified'])->group(function () {

    Route::get('/dashboard', function () { $user = auth()->user(); $canManage = $user->hasRole('manager');
        return view('dashboard', compact('canManage'));
    })->name('dashboard');

    Route::prefix('billing')->group(function () {
        Route::get('/', BillingDashboard::class)->name('billing');
        Route::get('/portal', [\App\Http\Controllers\BillingController::class, 'createPortalSession'])->name('billing.portal');
        Route::get('/events', [\App\Http\Controllers\JoinedEventsController::class, 'index'])->name('joined.events');
        Route::post('/events/{event}/cancel', '\App\Http\Controllers\Frontend\EventsController@cancel')->name('events.cancel');
        Route::post('/search-events', '\App\Http\Controllers\JoinedEventsController@search')->name('event.search');
    });

    Route::get('/subscription', \App\Http\Livewire\Administration\Subscriptions\Subscription::class)->name('subscription');
    Route::get('/subscription/checkout', [SubscriptionController::class, 'checkout'])->name('subscription.checkout');
    Route::get('/subscription/checkout/success', [SubscriptionController::class, 'success'])->name('subscription.checkout.success');
    Route::get('/subscription/checkout/cancel', [SubscriptionController::class, 'cancel'])->name('subscription.checkout.cancel');

    Route::prefix('lessons')->group(function () {
        Route::get('/shop', LessonsShop::class)->name('lessons.shop');
        Route::get('/page/{lesson_id}', LessonPage::class)->name('lessons.page');
        Route::get('/preview/{lesson_id}', LessonPreview::class)->name('lessons.preview');
    });

    Route::get('/message', function () { return view('message'); })->name('message');
    Route::get('/interventions', function () { return view('interventions'); })->name('interventions');
    Route::get('/events', [\App\Http\Controllers\Frontend\EventsController::class, 'index'])->name('events.index');
    Route::get('/shop', [\App\Http\Controllers\Frontend\ProductsController::class, 'index'])->name('shop.index');
    Route::get('/recipes', [\App\Http\Controllers\Frontend\RecipesController::class, 'index'])->name('recipes.index');
    Route::get('/rentals', [\App\Http\Controllers\Frontend\RentalsController::class, 'index'])->name('rentals.index');
    Route::post('/search-events', '\App\Http\Controllers\Frontend\EventsController@search')->name('events.search');

    Route::post('/events/{event}/register', '\App\Http\Controllers\Frontend\EventsController@register')->name('events.register');

    Route::post('/search-recipes', '\App\Http\Controllers\Frontend\RecipesController@search')->name('recipes.search');

    Route::prefix('cart')->group(function () {
        Route::get('/', Cart::class)->name('cart');
        Route::get('/success', [Cart::class, 'success'])->name('cart.checkout.success');
        Route::get('/cancel', function(){return view('cart.checkout.cancel');})->name('cart.checkout.cancel');
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
    Route::resource('/materials', \App\Http\Controllers\Management\MaterialsController::class);
    Route::resource('/rooms', \App\Http\Controllers\Management\RoomsController::class);
    Route::resource('/events', \App\Http\Controllers\Management\EventsController::class);
    Route::resource('/products', \App\Http\Controllers\Management\ProductsController::class);
    Route::resource('/associations', \App\Http\Controllers\Management\AssociationsController::class);
    Route::resource('/recipes', \App\Http\Controllers\Management\RecipesController::class);

    Route::post('/search-events-materials', '\App\Http\Controllers\Management\EventsController@search_1')->name('events.search_1');
    Route::post('/search-events', '\App\Http\Controllers\Management\EventsController@search_2')->name('events.search_2');
    Route::post('/search-rooms', '\App\Http\Controllers\Management\RoomsController@search')->name('rooms.search');
    Route::post('/search-materials', '\App\Http\Controllers\Management\MaterialsController@search')->name('materials.search');
    Route::post('/search-products', '\App\Http\Controllers\Management\ProductsController@search')->name('products.search');
    Route::post('/search-recipes', '\App\Http\Controllers\Management\RecipesController@search')->name('recipes.search');
    Route::post('/search-rentals', '\App\Http\Controllers\Management\RentalsController@search')->name('rentals.search');
});

Route::middleware(['auth', 'provider'])->prefix('provider')->group(function () {
    Route::get('/', function(){
        return view('provider.index');
    })->name('provider');

    Route::get('/classes', ShowClasses::class)->name('provider.classes');
    Route::get('/classes/create', CreateClass::class)->name('provider.classes.create');

    Route::get('/lessons', ShowLessons::class)->name('provider.lessons');
    Route::get('/lessons/create', CreateLesson::class)->name('provider.lessons.create');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'administrator'
])->prefix('administration')
    ->group(function(){
        Route::get('/', function(){
            return view('administration.index');
        })->name('administration');

        Route::get('/users', function(){
            return view('administration.users.index');
        })->name('administration.users');

        Route::get('/subscriptions', function(){
            return view('administration.subscriptions.index');
        })->name('administration.subscriptions');

        Route::get('/subscriptions/modify/{id}', \App\Http\Livewire\Administration\Subscriptions\ModifySubscription::class);

        Route::get('/subscriptions/create', function(){
            return view('administration.subscriptions.create-subscription');
        })->name('administration.subscriptions.create');

        Route::get('/coupons', Coupon::class)->name('administration.coupons');
        Route::get('/coupons/create', CreateCoupon::class)->name('administration.coupons.create');
        Route::get('/coupons/{coupon_id}', ShowCodes::class)->name('administration.coupons.codes');
    });

