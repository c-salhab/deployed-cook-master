<?php

namespace App\Http\Livewire\Administration\Subscriptions;

use App\Models\Subscription;
use Livewire\Component;

class CreateSubscription extends Component
{
    public $name;
    public $price;
    public $currency;
    public $advantages = [];

    public $successMessage;

    protected $rules = [
        'name' => ['required', 'string'],
        'price' => ['required', 'string'],
        'currency' => ['required', 'string'],
        'advantages' => ['required'],
    ];

    protected $messages = [
        'name.required' => 'The subscription name cannot be empty.',
        'price.required' => 'The price name cannot be empty.',
        'advantages.required' => 'Show at least one advantage..',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function addAdvantages($string)
    {
        array_push($this->advantages, $string);
    }

    public function resetAdvantages()
    {
        $this->reset('advantages');
    }
    public function createSubscription()
    {
        $validatedData = $this->validate();
        $this->successMessage = 'Subscription has been created successfully.';
        $this->reset(['name','price','currency','advantages',]);
        //Subscription::create($validatedData);
    }
}
