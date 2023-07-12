<?php

namespace App\Http\Livewire\Administration\Subscriptions;

use App\Models\SubscriptionItem;
use Illuminate\Support\Collection;
use Livewire\Component;

class Subscription extends Component
{
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
