<?php

namespace App\Http\Livewire\Administration\Subscriptions;

use App\Http\Controllers\Subscription;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class ShowSubscriptions extends Component
{

    public function delete($id)
    {
        try{
            DB::table('subscriptions')->delete($id);

        }catch(Exception $e){
            Log::error('Error occurred when trying to delete subscription : ' . $e);
        }
    }
    public function render()
    {
        return view('livewire.administration.subscriptions.show-subscriptions', ['subscriptions' => \App\Models\Subscription::all()]);
    }
}
