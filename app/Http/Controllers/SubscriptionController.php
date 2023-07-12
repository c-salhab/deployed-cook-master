<?php

namespace App\Http\Controllers;

use App\Models\Events;
use App\Models\Materials;
use App\Models\Rentals;
use App\Models\RentalProduct;
use App\Models\Subscription;
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

        //Sub temporary saved in a cart column in user
        $user = User::find(auth()->user()->id);
        $user->update(['last_sub_id' => $price_id]);

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
            'allow_promotion_codes' => true,
            'success_url' => route('subscription.checkout.success'),
            'cancel_url' => route('subscription.checkout.cancel'),
        ]);
        return redirect()->away($checkout_session->url);
    }

    public function success(){
        $user = User::find(auth()->user()->id);
        $subscription = DB::table('subscriptions')->where('price_id', '=', $user->last_sub_id)->get();
        $user->update(['subscription_id' => $subscription[0]->id]);

        $subscription = Subscription::find($user->subscription_id);
        $user->update(['coupon_recipes' => $subscription->nb_recipes_month]);
        $user->update(['coupon_lessons' => $subscription->nb_lessons_month]);
        $user->update(['coupon_classess' => $subscription->nb_classes_month]);
        return view('subscription.checkout.success', ['subscription' => $subscription]);
    }
    public function cancel(){
        $user = User::find(auth()->user()->id);
        return view('subscription.checkout.cancel');
    }
}
