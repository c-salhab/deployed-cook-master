<?php

namespace App\Http\Controllers;

use App\Models\Events;
use App\Models\Rentals;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Stripe\Stripe;

class StripeController extends Controller
{
    public function session(Request $request)
    {
        //$user         = auth()->user();
        $productItems = [];

        Stripe::setApiKey(config('stripe.sk'));

        foreach (session('cart') as $id => $details) {
            $product_name = $details['name'];
            $total = $details['price'];
            $quantity = $details['quantity'];

            $two0 = "00";
            $unit_amount = "$total$two0";

            $productItems[] = [
                'price_data' => [
                    'product_data' => [
                        'name' => $product_name,
                    ],
                    'currency'     => 'EUR',
                    'unit_amount'  => $unit_amount,
                ],
                'quantity' => $quantity
            ];
        }

        $checkoutSession = \Stripe\Checkout\Session::create([
            'line_items'            => [$productItems],
            'mode'                  => 'payment',
            'allow_promotion_codes' => true,
            'metadata'              => [
                'user_id' => "0001"
            ],
            'customer_email' => "cairocoders-ednalan@gmail.com", //$user->email,
            'success_url' => route('success'),
            'cancel_url'  => route('cancel'),
        ]);

        return redirect()->away($checkoutSession->url);
    }

    public function success()
    {
        // Diminuer la quantité des produits
        foreach (session('cart') as $id => $details) {
            $name = $details['name'];
            $product = DB::table('rentals')->where('name', $name)->first();

            $event = Events::where('name', $name)->first();

            if ($product) {
                $quantity = $details['quantity'];
                $productModel = Rentals::find($product->id);
                $productModel->decreaseQuantity($quantity);
                $productModel->save();
            }

            if($event){
                $event->decreaseCapacity();
            }

        }

        return "Thanks for your order! You have just completed your payment. The seller will reach out to you as soon as possible.";
    }

    public function cancel()
    {
        return view('cancel');
    }
}
