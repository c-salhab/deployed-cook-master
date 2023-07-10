<form class="w-1/2">
    <div class="relative z-0 w-full mb-3 group">
        <input wire:model="name" type="text" name="name"  id="name" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
        <label for="name" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Name</label>
    </div>
    @error('name') <span class="error text-red-500 text-sm">{{ $message }}</span> @enderror
    <div class="relative z-0 w-full mb-3 group">
        <input wire:model="value" type="number" name="value" id="value" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
        <label for="value" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Value</label>
    </div>
    @error('value') <span class="error text-red-500 text-sm">{{ $message }}</span> @enderror
    <div class="mt-6 mb-3">
        <div class="flex items-center pl-4 border border-gray-200 rounded dark:border-gray-700">
            <input checked wire:model="isAmount" id="fixed" type="radio" value="true" name="bordered-radio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
            <label for="fixed" class="w-full py-4 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Fixed amount</label>
        </div>
        <div class="flex items-center pl-4 border border-gray-200 rounded dark:border-gray-700">
            <input wire:model="isAmount" id="percentage" type="radio" value="false" name="bordered-radio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
            <label for="percentage" class="w-full py-4 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Percentage</label>
        </div>
    </div>
    @if($duration_type == 'repeating')
        <div class="relative z-0 w-full mb-6 group">
            <input wire:model="duration_value" type="number" name="duration" id="duration" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
            <label for="duration" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Duration</label>
        </div>
    @endif
    <div class="my-3">
        <div class="flex items-center pl-4 border border-gray-200 rounded dark:border-gray-700">
            <input checked wire:model="duration_type" id="once" value="once" type="radio"  name="duration-radio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
            <label for="once" class="w-full py-4 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Once</label>
        </div>
        <div class="flex items-center pl-4 border border-gray-200 rounded dark:border-gray-700">
            <input wire:model="duration_type" id="repeating" value="repeating" type="radio" name="duration-radio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
            <label for="repeating" class="w-full py-4 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Repeating</label>
        </div>
        <div class="flex items-center pl-4 border border-gray-200 rounded dark:border-gray-700">
            <input wire:model="duration_type" id="forever" value="forever" type="radio" name="duration-radio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
            <label for="forever" class="w-full py-4 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Forever</label>
        </div>
    </div>
    <button wire:click="createCoupon" type="button" class="mt-3 bg-green-500 hover:bg-green-400 text-white font-bold py-2 px-4 border-b-4 border-green-700 hover:border-green-400 rounded">
        Create
    </button>
</form>
