<?php

namespace App\Http\Livewire\Administration\Subscriptions;

use App\Models\Subscription;
use Livewire\Component;
use Illuminate\Support\Collection;

class CreateSubscription extends Component
{
    public $name;
    public $price;
    public $currency ='eur';
    public $advantages = [];
    public $advantage;

    public $successMessage;
    public $errorMessage;

    protected $rules = [
        'name' => ['required', 'string'],
        'price' => ['required', 'integer'],
        'currency' => ['required', 'string'],
        'advantages' => ['required'],
    ];

    protected $messages = [
        'name.required' => 'The subscription name cannot be empty.',
        'price.required' => 'The price cannot be empty.',
        'advantages.required' => 'Show at least one advantage..',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function addAdvantage(): void
    {
        if(!empty($this->advantage)){
            $this->advantages[] = $this->advantage;
            $this->advantage = '';
        }
    }

    public function resetAdvantages(): void
    {
        $this->reset('advantages');
    }

    public function createSubscription()
    {
        $validatedData = $this->validate();
        $this->reset(['name','price','currency','advantages']);
        if(Subscription::create($validatedData)){
            $this->successMessage = 'Subscription has been created successfully.';
        }else{
            $this->errorMessage = 'An error occurred.';
        }
    }
}
