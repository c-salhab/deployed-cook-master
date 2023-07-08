<?php

namespace App\Http\Controllers;

use App\Models\Events;
use App\Models\Materials;
use App\Models\Rentals;
use App\Models\RentalProduct;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Stripe\Stripe;

class SubscriptionController extends Controller
{

    public function checkout(Request $request){

        $stripeSecretKey = config('stripe.sk');
        $price_id = $request->input('price_id');

        /* --------------------- TEST MODE ---------------------- */
        //$stripeSecretKey = config('stripe.sk_test');
        //$price_id = "price_1NQzk4FWvpUMtb2ud2uWIhpe";
        /* ------------------------------------------------------ */

        \Stripe\Stripe::setApiKey($stripeSecretKey);

        $mode = $request->input('mode');

        $checkout_session = \Stripe\Checkout\Session::create([
            'line_items' => [
                [
                    'price' => $price_id,
                    'quantity' => 1,
                ],
            ],
            'customer' => auth()->user()->customer_id,
            'mode' => $mode,
            'success_url' => route('subscription.checkout.success'),
            'cancel_url' => route('subscription.checkout.cancel'),
        ]);


        dd($checkout_session);
        return redirect()->away($checkout_session->url);
    }

    public function success(){
        return view('subscription.checkout.success');
    }
    public function cancel(){
        return view('subscription.checkout.cancel');
    }
}
