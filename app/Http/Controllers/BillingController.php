<?php

namespace App\Http\Controllers;

use App\Models\Events;
use App\Models\Materials;
use App\Models\Rentals;
use App\Models\RentalProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Stripe\Stripe;

class BillingController extends Controller
{

    public function createPortalSession(){

        $stripeSecretKey = config('stripe.sk');

        $stripe = new \Stripe\StripeClient($stripeSecretKey);

        $billing_session = $stripe->billingPortal->sessions->create([
            'customer' => auth()->user()->customer_id,
            'return_url' => route('billing'),
        ]);

        return redirect()->away($billing_session->url);
    }
}
