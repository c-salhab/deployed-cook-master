@if($successMessage)
    <div id="alert-3" class="flex p-4 mb-4 text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
        <svg aria-hidden="true" class="flex-shrink-0 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
        <span class="sr-only">Info</span>
        <div class="ml-3 text-sm font-medium">
            {{$successMessage}}
        </div>
        <button wire:click="$set('successMessage', null)" type="button" class="ml-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700" data-dismiss-target="#alert-3" aria-label="Close">
            <span class="sr-only">Close</span>
            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
        </button>
    </div>
@endif
<div class="grid grid-cols-2 grid-flow-row gap-x-16">
    <form wire:submit.prevent="createSubscription" class="col-span-1 w-full max-w-lg">
        <div class="grid grid-cols-4 gap-x-1 gap-y-6">
            <div class="col-span-4 px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                    Name
                </label>
                <input wire:model="name" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" type="text" placeholder="Chief">
                @error('name') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="col-span-2 px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                    Price
                </label>
                <input wire:model="price" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" type="text" placeholder="10">
                @error('price') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="col-span-2 px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-state">
                    Currency
                </label>
                <div class="relative">
                    <select wire:model="currency" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-state">
                        <option>eur</option>
                        <option>usd</option>
                    </select>
                </div>
            </div>
            <div class="col-span-2 px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                    Advantages
                </label>
                <input wire:model="advantage" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" type="text" placeholder="Unlimited pasta">
            </div>
            <div class="col-span-1 px-3 content-center">
                <button type="button" wire:click="addAdvantages" class="mt-6 bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-10 border-b-4 border-blue-700 hover:border-blue-400 rounded">
                    Fly
                </button>
            </div>
            <div class="col-span-1 px-3 content-center">
                <button type="button" wire:click="resetAdvantages" class="mt-6 bg-red-500 hover:bg-red-400 text-white font-bold py-2 px-4 border-b-4 border-red-700 hover:border-red-400 rounded">
                    Reset all
                </button>
            </div>
            <button type="submit" class="col-span-4 mt-3 mx-3 bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-16 border-b-4 border-blue-700 hover:border-blue-400 rounded">
                Create subscription
            </button>
        </div>
    </form>
    <x-administration.subscriptions.subscription-card class="col-span-2" :name="$name" :currency="$currency" :price="$price" :advantages="$advantages">
    </x-administration.subscriptions.subscription-card>
</div>
