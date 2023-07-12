<?php

namespace App\Http\Livewire\Administration\Subscriptions;

use App\Models\Subscription;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class ModifySubscription extends Component
{
    public $subscription;
    public $name;
    public $price;
    public $currency;
    public $advantages = [];
    public $advantage;



    public $successMessage;
    public $errorMessage;

    protected $rules = [
        'subscription.name' => ['required', 'string'],
        'subscription.price' => ['required', 'integer'],
        'subscription.currency' => ['required', 'string'],
        'subscription.advantages' => ['required'],
    ];

    protected $messages = [
        'subscription.name.required' => 'The subscription name cannot be empty.',
        'subscription.price.required' => 'The price cannot be empty.',
        'subscription.advantages.required' => 'Show at least one advantage..',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function addAdvantage(): void
    {
        if(!empty($this->advantage)){
            $this->advantages[] = $this->advantage;
            $this->advantage = '';
        }
    }

    public function resetAdvantages(): void
    {
        $this->reset('advantages');
    }

    public function mount($id)
    {
        $this->subscription = Subscription::all()->find($id);
        $items = DB::table('subscription_items')->where('subscription_id', '=', $id)->get();

        $this->name = $this->subscription->name;
        $this->price = $this->subscription->price;
        $this->currency = $this->subscription->currency;

        foreach ($items as $item){
            $this->advantages[] = $item->description;
        }
    }

    public function modifySubscription(){

        $stripeSecretKey = config('stripe.sk');
        $stripe = new \Stripe\StripeClient($stripeSecretKey);

        try{
            $stripe->products->update(
                $this->subscription->product_id,
                ['name' => $this->name]
            );

            $price = $stripe->prices->create([
                'unit_amount' => (int)($this->price * 100),
                'currency' => $this->currency,
                'recurring' => ['interval' => 'month'],
                'product' => $this->subscription->product_id,
            ]);

            $stripe->products->update(
                $this->subscription->product_id,
                ['default_price' => $price->id]
            );

            DB::table('subscriptions')
                ->where('id', '=', $this->subscription->id)
                ->update([
                    'name' => $this->name,
                    'price' => $this->price,
                    'currency' => $this->currency,
                    'price_id' => $price->id,
                    'updated_at' => now()
                ]);

            DB::table('subscription_items')->where('subscription_id', '=', $this->subscription->id)->delete();

            foreach ($this->advantages as $advantage){
                DB::table('subscription_items')->insert(
                    [
                        'description' => $advantage,
                        'subscription_id' => $this->subscription->id,
                    ]
                );
            }

            $this->successMessage = 'Subscription has been modified successfully.';
        }catch(\Exception $e){
            Log::error('An error occurred : ' . $e);
            $this->errorMessage = 'An error occurred : ' . $e;
        }
    }

    public function render()
    {
        return view('livewire.administration.subscriptions.modify-subscription', ['subscription' => $this->subscription, 'advantages' => $this->advantages])->layout('layouts.admin');
    }
}
