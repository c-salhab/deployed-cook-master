<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        @if($lessons->isEmpty())
            <h1 class="mb-4 text-4xl font-extrabold leading-none tracking-tight text-gray-900 md:text-5xl lg:text-6xl dark:text-white">We currently don't have any lesson available yet.</h1>
        @else
            <div class="sm:p-6 lg:p-8 bg-white overflow-hidden shadow-xl sm:rounded-lg grid grid-cols-4 gap-8 h-full">
                @foreach($lessons as $lesson)
                    <div class="grid-span-1 max-w-sm rounded overflow-hidden shadow-lg h-full">
                        <img class="w-full h-48" src="{{env('APP_URL').$lesson->image_url}}" alt="{{$lesson->title}}">
                        <div class="px-6 py-4">
                            <div class="font-bold text-xl mb-2">{{$lesson->title}}</div>
                            <p class="text-gray-700 text-base">
                                {{$lesson->description . '...'}}
                            </p>
                        </div>

                        <div class="grid-span-1 grid grid-cols-2 place-items-center px-6">
                            <div class="grid-span-1 grid grid-cols-5 place-items-center">
                                <svg class="w-4 h-4 text-yellow-300 mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                    <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                                </svg>
                                <svg class="w-4 h-4 text-yellow-300 mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                    <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                                </svg>
                                <svg class="w-4 h-4 text-yellow-300 mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                    <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                                </svg>
                                <svg class="w-4 h-4 text-yellow-300 mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                    <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                                </svg>
                                <svg class="w-4 h-4 text-gray-300 mr-1 dark:text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                    <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                                </svg>
                            </div>
                            <p class="grid-span-1 ml-2 text-sm font-medium text-gray-500 dark:text-gray-400">4.95 out of 5</p>
                        </div>

                        <div class="grid grid-cols-2 px-6 py-4">
                            <a href="/lessons/preview/{{$lesson->id}}" class="grid-span-1">
                                <button class="bg-blue-500 hover:bg-blue-400 text-gray-900 bg-gray-100 font-bold py-2 px-4 border-b-4 border-gray-400  hover:bg-gray-100 hover:text-blue-700 rounded text-sm	">
                                    Preview
                                </button>
                            </a>
                            @if($lesson['active'])
                                <button wire:click="removeCart({{$lesson->id}})" class="grid-span-1 bg-red-500 hover:bg-red-400 text-white font-bold py-2 px-4 border-b-4 border-red-700 hover:border-red-500 rounded text-sm">
                                    Remove
                                </button>
                            @else
                                <button wire:click="addCart({{$lesson->id}})" class="grid-span-1 bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 border-b-4 border-blue-700 hover:border-blue-500 rounded text-sm">
                                    Add to cart
                                </button>
                            @endif

                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>