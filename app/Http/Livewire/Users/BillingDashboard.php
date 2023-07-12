<?php

namespace App\Http\Livewire\Users;

use App\Models\User;
use Livewire\Component;

class BillingDashboard extends Component
{

    public function check()
    {
        $stripeSecretKey = config('stripe.sk');
        $stripe = new \Stripe\StripeClient($stripeSecretKey);
        $subscription = $stripe->subscriptions->all(['limit' => 50]);

        $user = auth()->user();

        foreach ($subscription->data as $data){
            if($data->customer == $user->customer_id){
                $product = $stripe->products->retrieve(
                    $data->plan->product,
                    []
                );
                $updatedUser = User::find($user->id);
                if($data->cancel_at_period_end){
                    $updatedUser->update(['subscription_id' => 1]);
                    break;
                }else{
                    $updatedUser->update(['subscription_id' => $product->metadata->subscription_id]);
                    break;
                };
            };
        }
    }

    public function render()
    {
        $this->check();
        return view('billing.index')->layout('layouts.billing');
    }
}
