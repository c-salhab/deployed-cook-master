<?php

namespace App\Http\Livewire\Administration\Coupons;

use Livewire\Component;
use Livewire\WithPagination;

class ShowCodes extends Component
{
    public $coupon_id;
    public $code;

    public function mount(string $coupon_id)
    {
        $this->coupon_id = $coupon_id;
    }

    public function create(){
        $stripe = new \Stripe\StripeClient(config('stripe.sk'));
        $stripe->promotionCodes->create([
            'coupon' => $this->coupon_id,
            'code' => $this->code
        ]);
    }
    public function render(){
        $stripe = new \Stripe\StripeClient(config('stripe.sk'));
        $codes = $stripe->promotionCodes->all(
            [
                'limit' => 10,
                'coupon' => $this->coupon_id
            ]
        );
        return view('administration.coupons.codes', ['codes' => $codes])->layout('layouts.admin');
    }
}