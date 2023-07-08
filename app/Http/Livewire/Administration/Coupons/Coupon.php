<?php

namespace App\Http\Livewire\Administration\Coupons;

use Livewire\Component;

class Coupon extends Component
{
    public function delete($id){
        $stripe = new \Stripe\StripeClient(config('stripe.sk'));
        $stripe->coupons->delete($id, []);
    }
    public function render(){
        $stripe = new \Stripe\StripeClient(config('stripe.sk'));
        $coupons = $stripe->coupons->all(['limit' => 15]);
        return view('administration.coupons.index', ['coupons' => $coupons])->layout('layouts.admin');
    }
}