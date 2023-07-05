<?php

namespace App\Http\Livewire\Administration\Subscriptions;

use App\Http\Controllers\Subscription;
use Livewire\Component;

class ShowSubscriptions extends Component
{

    public function render()
    {
        return view('livewire.administration.subscriptions.show-subscriptions', ['subscriptions' => \App\Models\Subscription::all()]);
    }
}
