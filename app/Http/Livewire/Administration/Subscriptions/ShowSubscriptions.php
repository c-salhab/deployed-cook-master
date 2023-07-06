<?php

namespace App\Http\Livewire\Administration\Subscriptions;

use \App\Models\Subscription;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class ShowSubscriptions extends Component
{

    public function deleteSubscription($id, $productId){
        dd($id);
        Subscription::deleteAll($id, $productId);
    }
    public function render()
    {
        return view('livewire.administration.subscriptions.show-subscriptions', ['subscriptions' => \App\Models\Subscription::all()]);
    }
}
