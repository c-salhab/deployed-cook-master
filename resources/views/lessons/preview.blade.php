
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 mb-6">
            <div class="grid-span-1">
                <h1 class="mb-4 text-4xl font-extrabold leading-none tracking-tight text-gray-900 md:text-5xl lg:text-6xl dark:text-white">{{$lesson->title}}</h1>
                <img class="h-80" src="{{env('APP_URL') . $lesson->image_url}}">
            </div>
            <div class="grid-span-1">
                <p class="mb-6 text-lg font-normal text-gray-500 lg:text-xl sm:pr-16 xl:pr-48 dark:text-gray-400">Duration : {{$duration}}</p>
                <p class="mb-6 text-lg font-normal text-gray-500 lg:text-xl sm:pr-16 xl:pr-48 dark:text-gray-400">Difficulty : {{$lesson->difficulty}}</p>
                <p class="mb-6 text-lg font-normal text-gray-500 lg:text-xl sm:pr-16 xl:pr-48 dark:text-gray-400">{{$lesson->description}}</p>
            </div>
        </div>

        <a href="#" class="pr-3  inline-flex items-center justify-center pl-5 py-3 text-base font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-900">
            Add to cart
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-cart ml-2" viewBox="0 0 16 16"> <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/> </svg>
        </a>
    </div>
</div>