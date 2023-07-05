<?php

namespace App\Http\Livewire;

use App\Models\SubscriptionItem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Collection;

class Subscription extends Component
{
     public function checkout($price_id): RedirectResponse
     {
         return redirect()->away(\App\Models\Subscription::subscribe($price_id));
     }

    protected function fetchSubscriptions(): Collection{
        $subscriptions = \App\Models\Subscription::all();
        $subscription_items = SubscriptionItem::all()->groupBy('subscription_id');
        return $subscriptions->map(function ($subscription) use ($subscription_items) {
            $subscriptionId = $subscription->id;
            $subscription->items = $subscription_items[$subscriptionId] ?? [];
            return $subscription;
        });
    }

    public function render()
    {
        return view('livewire.subscription', ['subscriptions' => $this->fetchSubscriptions()]);
    }
}
