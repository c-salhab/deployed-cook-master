<?php

namespace App\Http\Livewire\Administration\Coupons;

use Livewire\Component;
use Livewire\WithPagination;

class ShowCodes extends Component
{
    public $coupon_id;
    public $code;
    public $number = 1;

    public function mount(string $coupon_id)
    {
        $this->coupon_id = $coupon_id;
    }

    public function createCode(){

        $options = [];
        $options['coupon'] = $this->coupon_id;
        $options['max_redemptions'] = $this->number;
        if($this->code != ''){
            $options['code'] = $this->code;
        }

        $stripe = new \Stripe\StripeClient(config('stripe.sk'));
        $stripe->promotionCodes->create($options);
    }

    public function deleteCode($id){

    }
    public function render(){
        $stripe = new \Stripe\StripeClient(config('stripe.sk'));
        $codes = $stripe->promotionCodes->all(
            [
                'limit' => 20,
                'coupon' => $this->coupon_id
            ]
        );
        return view('administration.coupons.codes', ['codes' => $codes])->layout('layouts.admin');
    }
}