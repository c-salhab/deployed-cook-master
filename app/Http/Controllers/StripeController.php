<?php

namespace App\Http\Controllers;

use App\Models\Events;
use App\Models\Materials;
use App\Models\Rentals;
use App\Models\RentalProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Stripe\Stripe;

class StripeController extends Controller
{
    public function index(){
    }
    public function checkout(Request $request){

        //$stripeSecretKey = config('stripe.sk');
        //$price_id = $request->input('price_id');

        /* --------------------- TEST MODE ---------------------- */
        $stripeSecretKey = config('stripe.sk_test');
        $price_id = "price_1NQzk4FWvpUMtb2ud2uWIhpe";
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
            'mode' => $mode,
            'success_url' => route('success'),
            'cancel_url' => route('cancel'),
            'automatic_tax' => [
                'enabled' => true,
            ],
        ]);

        return redirect()->away($checkout_session->url);
    }

    public function success(){
        return view('checkout.success');
    }
    public function cancel(){
        return view('checkout.cancel');
    }
}
