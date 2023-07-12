<div>
    @if($codes->isEmpty())
        <div class="bg-orange-100 border-l-4 border-orange-500 text-orange-700 p-4" role="alert">
            <p class="font-bold">Hold up</p>
            <p>No promotion code has been created yet !</p>
        </div>
    @else
        <div class="mt-6 bg-white w-64 2 overflow-hidden shadow-xl sm:rounded-lg">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Code
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Number left
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($codes->data as $code)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                {{$code->code}}
                            </th>
                            <td class="text-center px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{$code->max_redemptions - $code->times_redeemed}}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
    <form class="mt-3 grid grid-cols-3 w-96">
        <div class="col-span-1">
            <input wire:model="code" type="text" placeholder="ESGI1" id="default-input" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
        </div>
        <div class="col-span-1">
            <input wire:model="number" type="number" placeholder="1" id="default-input" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
        </div>
        <button wire:click="createCode" type ="button" class="col-span-1 bg-green-500 hover:bg-green-400 text-white font-bold py-2 px-4 border-b-4 border-green-700 hover:border-green-400 rounded">
            Create code
        </button>
    </form>
</div>


