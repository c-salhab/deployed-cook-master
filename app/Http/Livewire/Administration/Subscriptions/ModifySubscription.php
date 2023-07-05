<?php

namespace App\Http\Livewire\Administration\Subscriptions;

use App\Models\Subscription;
use Livewire\Component;

class ModifySubscription extends Component
{

    public $subscription;

    public function mount($id)
    {
        $this->subscription = Subscription::all()->find($id);
    }
    public function render()
    {
        return view('livewire.administration.subscriptions.modify-subscription', ['subscription' => $this->subscription])->layout('layouts.admin');
    }
}
