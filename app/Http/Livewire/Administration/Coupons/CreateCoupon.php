<?php

namespace App\Http\Livewire\Administration\Coupons;

use Livewire\Component;

class CreateCoupon extends Component
{
    public $name;
    public $value;
    public $isAmount  = 'true';

    public $duration_type = 'once';
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
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function createCoupon(){

        $stripe = new \Stripe\StripeClient(config('stripe.sk'));

        $options = [];

        $options['name'] = $this->name;

        if ($this->isAmount == 'true') {
            $options['amount_off'] = $this->value;
            $options['currency'] = 'eur';
        } else {
            $options['percent_off'] = $this->value;
        }

        $options['duration'] = $this->duration_type;

        if ($this->duration_type == 'repeating') {
            $options['duration_in_months'] = $this->duration_value;
        }

        $stripe->coupons->create($options);

        redirect()->away('administration/coupons');
    }
    public function render(){
        return view('administration.coupons.create')->layout('layouts.admin');
    }
}