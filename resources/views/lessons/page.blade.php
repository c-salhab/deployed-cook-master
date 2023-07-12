
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
        <div class="w-auto my-16">
            @foreach($lesson_steps as $step)
                @if($step->order%2 != 0)
                    <div class="inline-flex items-center justify-center w-full">
                        <hr class="w-full h-px my-8 bg-gray-400 border-0 dark:bg-gray-700">
                        <span class="py-2 px-5 text-3xl absolute px-3 font-extrabold text-gray-900 -translate-x-1/2 bg-white left-1/2 dark:text-white dark:bg-gray-900">Step {{$step->order}}</span>
                    </div>
                    <div class="grid grid-cols-2 my-16">
                        <div>

                            <h2 class="mb-2 mt-0 text-4xl font-medium leading-tight text-primary">
                                {{$step->sub_title . ' (' . $step->duration . ' min)'}}
                            </h2>
                            <h2 class="mb-2 mt-0 text-4xl font-medium leading-tight text-primary">
                                {{$step->description}}
                            </h2>
                        </div>
                        <video controls class="aspect-video">
                            <source src="{{env('APP_URL') . $step->video_url}}" type="video/mp4">
                        </video>
                    </div>
                @else
                    <div class="inline-flex items-center justify-center w-full">
                        <hr class="w-full h-px my-8 bg-gray-400 border-0 dark:bg-gray-700">
                        <span class="py-2 px-5 text-3xl absolute px-3 font-extrabold text-gray-900 -translate-x-1/2 bg-white left-1/2 dark:text-white dark:bg-gray-900">Step {{$step->order}}</span>
                    </div>
                    <div class="grid grid-cols-2 my-16">
                        <video controls class="aspect-video">
                            <source src="{{env('APP_URL') . $step->video_url}}" type="video/mp4">
                        </video>
                        <div class="ml-6">
                            <h2 class="mb-2 mt-0 text-4xl font-medium leading-tight text-primary">
                                {{$step->sub_title . ' (' . $step->duration . ' min)'}}
                            </h2>
                            <h2 class="mb-2 mt-0 text-4xl font-medium leading-tight text-primary">
                                {{$step->description}}
                            </h2>
                        </div>

                    </div>
                @endif
            @endforeach
        </div>

        <a href="{{route('lessons.shop')}}">
            <button class="grid-span-1 bg-blue-500 hover:bg-blue-400 text-white text-3xl font-bold py-2 px-4 border-b-4 border-blue-700 hover:border-blue-500 rounded">
                Go back
            </button>
        </a>
    </div>
</div>
