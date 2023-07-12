<div class="container mx-auto mt-10">
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
    <div class="flex shadow-md my-10">
        <div class="w-3/4 bg-white px-10 py-10">
            <div class="flex justify-between border-b pb-8">
                <h1 class="font-semibold text-2xl">Shopping Cart</h1>
                <h2 class="font-semibold text-2xl">
                    @if($number_items == 0)
                        0 item
                    @else
                        {{($number_items > 1) ? $number_items . ' items' : $number_items . ' item'}}
                    @endif
                </h2>
            </div>
            <div class="flex mt-10 mb-5">
                <h3 class="font-semibold text-gray-600 text-xs uppercase w-2/5">Product Details</h3>
                <h3 class="font-semibold text-center text-gray-600 text-xs uppercase w-1/5 text-center">Price</h3>
            </div>
            @if(!empty($lessons))
                <hr class="w-48 h-1 mx-auto my-4 bg-gray-100 border-0 rounded md:my-10 dark:bg-gray-700">
                <p class="text-gray-500 dark:text-gray-400">Lessons</p>
                @foreach($lessons as $lesson)
                    <div class="flex items-center hover:bg-gray-100 -mx-8 px-6 py-5">
                        <div class="flex w-2/5"> <!-- product -->
                            <div class="w-24">
                                <img class="h-24 w-24" src="{{env('APP_URL') . $lesson[0]->image_url}}" alt="">
                            </div>
                            <div class="flex flex-col justify-between ml-4 flex-grow">
                                <span class="font-bold text-2xl">{{$lesson[0]->title}}</span>
                                <a href="#" class="font-semibold hover:text-green-500 text-gray-500 text-xs">Use coupon</a>
                                <a href="#" class="font-semibold hover:text-red-500 text-gray-500 text-xs">Remove</a>
                            </div>
                        </div>
                        <span class="text-center w-1/5 font-semibold text-sm">{{$lesson[0]->price}} €</span>
                    </div>
                @endforeach
            @endif
            @if(!empty($classes))
                <hr class="w-48 h-1 mx-auto my-4 bg-gray-100 border-0 rounded md:my-10 dark:bg-gray-700">
                <p class="text-gray-500 dark:text-gray-400">Certificated courses</p>
                @foreach($classes as $class)
                    <div class="flex items-center hover:bg-gray-100 -mx-8 px-6 py-5">
                        <div class="flex w-2/5"> <!-- product -->
                            <div class="w-24">
                                <img class="h-24 w-24" src="{{env('APP_URL') . $class[0]->image_url}}" alt="">
                            </div>
                            <div class="flex flex-col justify-between ml-4 flex-grow">
                                <span class="font-bold text-2xl">{{$class[0]->title}}</span>
                                <a href="#" class="font-semibold hover:text-green-500 text-gray-500 text-xs">Use coupon</a>
                                <a href="#" class="font-semibold hover:text-red-500 text-gray-500 text-xs">Remove</a>
                            </div>
                        </div>
                        <span class="text-center w-1/5 font-semibold text-sm">{{$class[0]->price}} €</span>
                    </div>
                @endforeach
            @endif
            <a href="{{route('dashboard')}}" class="flex font-semibold text-indigo-600 text-sm mt-10">
                <svg class="fill-current mr-2 text-indigo-600 w-4" viewBox="0 0 448 512"><path d="M134.059 296H436c6.627 0 12-5.373 12-12v-56c0-6.627-5.373-12-12-12H134.059v-46.059c0-21.382-25.851-32.09-40.971-16.971L7.029 239.029c-9.373 9.373-9.373 24.569 0 33.941l86.059 86.059c15.119 15.119 40.971 4.411 40.971-16.971V296z"/></svg>
                Go back
            </a>
        </div>

        <div id="summary" class="w-1/4 px-8 py-10">
            <h1 class="font-semibold text-2xl pb-8">Order Summary</h1>
            <span class="mt-10 font-extrabold text-sm uppercase text-green-400">Subscription coupons</span>
            <div class="flex justify-between mt-6 mb-5">
                <span class="font-semibold text-sm uppercase">Recipes : </span>
                <span class="font-semibold text-sm">{{auth()->user()->coupon_recipes}}</span>
            </div>
            <div class="flex justify-between mt-3 mb-5">
                <span class="font-semibold text-sm uppercase">Lessons : </span>
                <span class="font-semibold text-sm">{{auth()->user()->coupon_lessons}}</span>
            </div>
            <div class="flex justify-between mt-3 mb-5">
                <span class="font-semibold text-sm uppercase">Certified courses : </span>
                <span class="font-semibold text-sm">{{auth()->user()->coupon_classes}}</span>
            </div>

            <div class="border-t mt-auto">
                <div class="flex font-semibold justify-between py-6 text-sm uppercase">
                    <span>Total cost</span>
                    <span>{{$total_price}} €</span>
                </div>
                <button wire:click="checkout" class="bg-indigo-500 font-semibold hover:bg-indigo-600 py-3 text-sm text-white uppercase w-full">Checkout</button>
            </div>
        </div>
    </div>
</div>
