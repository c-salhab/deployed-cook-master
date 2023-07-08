@if($coupons->isEmpty())
    <div class="bg-orange-100 border-l-4 border-orange-500 text-orange-700 p-4" role="alert">
        <p class="font-bold">Hold up</p>
        <p>No coupon has been created yet !</p>
    </div>
@else
    <div class="mt-6 bg-white w-1/2 overflow-hidden shadow-xl sm:rounded-lg">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Code
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <div class="flex items-center">
                            Amount
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <div class="flex items-center">
                            Duration
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <span class="sr-only">Delete</span>
                    </th>
                </tr>
                </thead>
                <tbody>
                    @foreach($coupons as $coupon)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                {{$coupon->name}}
                            </th>
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{$coupon->id}}
                            </td>
                            <td class="px-6 py-4">
                                @if($coupon->amount_off)
                                    {{$coupon->amount_off . ' €'}}
                                @else
                                    {{$coupon->percent_off . ' %'}}
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                {{$coupon->duration}}
                            </td>
                            <td class="px-6 py-4 text-right">
                                <button wire:click="delete('{{$coupon->id}}')" type="button" class="font-medium text-red-500 dark:text-red-400 hover:underline">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endif

<a href="{{route('administration.coupons.create')}}">
    <button class="mt-3 bg-green-500 hover:bg-green-400 text-white font-bold py-2 px-4 border-b-4 border-green-700 hover:border-green-400 rounded">
        Create coupon
    </button>
</a>
