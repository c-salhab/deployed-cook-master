<?php

namespace App\Http\Livewire\Administration\Coupons;

use Livewire\Component;

class CreateCoupon extends Component
{
    public $name;
    public $value;
    public $isAmount;

    public $duration_type;
    public $duration_value;

    protected $rules = [
        'name' => ['required', 'string'],
        'value' => ['required', 'numeric'],
        'isAmount' => ['required', 'boolean'],
        'duration_type' => ['required', 'string'],
    ];

    protected $messages = [
        'name.required' => 'The coupon name cannot be empty.',
        'value.required' => 'The reduction cannot be empty.',
        'advantages.required' => 'Show at least one advantage..',
    ];
    public function createCoupon(){
        $stripe = new \Stripe\StripeClient(config('stripe.sk'));
        $stripe->coupons->create([
            'amount_off' => $this->isAmount ? $this->value : null,
            'percent_off' => !$this->isAmount ? $this->value : null,
            'duration' => $this->duration_type,
            'duration_in_months' => $this->duration_type == 'repeating'? $this->duration_value : null,
        ]);
    }
    public function render(){
        return view('administration.coupons.create');
    }
}