<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Exception;

class Subscription extends Model
{
    use HasFactory;

    public static function create(array $validatedData)
    {

        //Create the product
        try{
            $stripeSecretKey = config('stripe.sk');
            $stripe = new \Stripe\StripeClient($stripeSecretKey);
            $product = $stripe->products->create([
                'name' => $validatedData['name'],
                'active' => $validatedData['active'],
            ]);

            //Create a subscription price
            $response = $stripe->prices->create([
                'unit_amount' => $validatedData['price'] * 100,
                'currency' => $validatedData['currency'],
                'recurring' => $validatedData['recurring'],
                'product' => $product->id,
            ]);
        }catch(Exception $e){
            dd('Stripe api error occured : ' . $e);
        }

        try{
            $id = DB::table('subscriptions')->insertGetId(
                [
                    'name' => $validatedData['name'],
                    'price' => $validatedData['price'],
                    'currency' => $validatedData['currency'],
                    'stripe_product_key' => $response->product,
                    'stripe_price_key' => $response->id,
                    'created_at' => now(),
                    'updated_at' => now()
                ]
            );

            foreach ($validatedData['advantages'] as $advantage){
                SubscriptionItem::create($advantage, $id);
            }
        }catch(Exception $e){
        dd('Database error occured : ' . $e);
        }
    }
}
