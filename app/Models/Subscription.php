<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
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
                'active' => true,
            ]);

            //Create a subscription price
            $response = $stripe->prices->create([
                'unit_amount' => $validatedData['price'] * 100,
                'currency' => $validatedData['currency'],
                'recurring' => [
                    'interval' => 'month',
                ],
                'product' => $product->id,
            ]);
        }catch(Exception $e){
            Log::error('Stripe api error occurred : ' . $e);
        }

        try{
            $id = DB::table('subscriptions')->insertGetId(
                [
                    'name' => $validatedData['name'],
                    'price' => $validatedData['price'],
                    'currency' => $validatedData['currency'],
                    'product_id' => $response->product,
                    'price_id' => $response->id,
                    'created_at' => now(),
                    'updated_at' => now()
                ]
            );

            foreach ($validatedData['advantages'] as $advantage){
                DB::table('subscription_items')->insert(
                    [
                        'description' => $advantage,
                        'subscription_id' => $id,
                    ]
                );
            }

        }catch(Exception $e){
            Log::error('Database error occurred : ' . $e);
        }
    }
    
    public function deleteAll(int $id, string $productId){

        try{
            DB::table('subscription_items')->where('subscription_id', '=', $id)->delete();
        }catch(\Exception $e){
            Log::error("Errored occurred while trying to delete a subscription's item. " . $e);
        }
        try{
            DB::table('subscriptions')->where('id', '=', $id)->delete();
        }catch(\Exception $e){
            Log::error("Errored occurred while trying to delete a subscription. " . $e);
        }

        $stripeSecretKey = config('stripe.sk');

        $stripe = new \Stripe\StripeClient($stripeSecretKey);
        $stripe->products->delete(
            $productId,
            []
        );
    }
}
