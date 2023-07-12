
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 mb-6">
            <div class="grid-span-1">
                <h1 class="mb-4 text-4xl font-extrabold leading-none tracking-tight text-gray-900 md:text-5xl lg:text-6xl dark:text-white">{{$lesson->title}}</h1>
            </div>
            <div class="grid grid-cols-2 grid-span-1">
                <img class="grid-span-1 h-80" src="{{env('APP_URL') . $lesson->image_url}}">
                <div class="grid-span-1 grid">
                    <div class="flex flex-row mb-6">
                        <div class="grow-0 place-self-center">
                            <p class="font-bold text-lg text-gray-700 lg:text-xl dark:text-gray-400">Duration : {{$duration}} min</p>
                            <p class="font-bold text-lg text-gray-700 lg:text-xl dark:text-gray-400">Difficulty : {{$lesson->difficulty}}</p>
                        </div>
                        <div class="ml-auto">
                            @if($creator->profile_photo_path)
                                <div class="flex flex-row">
                                    <img class="grid-span-1 rounded-full w-24 h-24" src="{{env('APP_URL') . $creator->profile_photo_path}}" alt="creator_pfp">
                                    <p class="ml-6 place-self-center grid-span-1 font-bold text-2xl text-gray-700 lg:text-6xl dark:text-gray-400">{{$creator->name}}</p>
                                </div>
                            @else
                                <p class="grid-span-2 font-bold	mb-6 text-2xl text-gray-700 lg:text-6xl sm:pr-8 xl:pr-16 dark:text-gray-400">{{$creator->name}}</p>
                            @endif
                        </div>
                    </div>
                    <div>
                        <p class="grid-span-2 mb-6 text-lg font-normal text-gray-500 lg:text-xl dark:text-gray-400">{{$lesson->description}}</p>
                    </div>
                </div>

            </div>
        </div>
        <a href="{{route('lessons.shop')}}">
            <button class="grid-span-1 bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 border-b-4 border-blue-700 hover:border-blue-500 rounded text-sm">
                Go back
            </button>
        </a>
        @if(!$lesson['possessed'])
            @if($lesson['active'])
                <button wire:click="removeCart({{$lesson->id}})" class="grid-span-1 bg-red-500 hover:bg-red-400 text-white font-bold py-2 px-4 border-b-4 border-red-700 hover:border-red-500 rounded text-sm">
                    Remove
                </button>
            @else
                <button wire:click="addCart({{$lesson->id}})" class="grid-span-1 bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 border-b-4 border-blue-700 hover:border-blue-500 rounded text-sm">
                    Add to cart
                </button>
            @endif
        @endif
    </div>
</div>
