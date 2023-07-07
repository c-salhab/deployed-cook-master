<?php

namespace App\Http\Livewire;

use App\Models\SubscriptionItem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Illuminate\Support\Collection;

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
