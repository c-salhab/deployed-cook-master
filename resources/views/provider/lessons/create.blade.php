<div>
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
    @if($errorMessage)
        <div id="alert-3" class="flex p-4 mb-4 text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
            <svg aria-hidden="true" class="flex-shrink-0 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
            <span class="sr-only">Info</span>
            <div class="ml-3 text-sm font-medium">
                {{$errorMessage}}
            </div>
            <button wire:click="$set('errorMessage', null)" type="button" class="ml-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700" data-dismiss-target="#alert-3" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
            </button>
        </div>
    @endif
    <form wire:submit.prevent="createLesson" class="w-1/2">
        @csrf
        <div class="relative z-0 w-full mb-3 group">
            <input wire:model="lesson.title" id="title" type="text" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
            <label for="title" class="peer-focus:font-medium absolute text-sm text-gray-900 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Name</label>
            @error('lesson.title') <span class="error text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
        <div class="relative z-0 w-full mb-3 group">
            <input wire:model="lesson.price" id="price" type="number" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
            <label for="price" class="peer-focus:font-medium absolute text-sm text-gray-900 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Price</label>
            @error('lesson.title') <span class="error text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
        <div class="mt-6 my-3 relative z-0 w-full group">
            <label for="description" class="block mb-2 text-sm text-gray-900 dark:text-white">Your description</label>
            <textarea wire:model="lesson.description" id="description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write the description of your lesson..."></textarea>
            @error('lesson.description') <span class="error text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="content-center mt-8 relative z-0 w-full mb-3 group grid grid-cols-2">
            <div class="col-span-1 ">
                <input wire:model="lesson.image" id="image" type="file" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                <label for="image" class="peer-focus:font-medium absolute text-sm text-gray-900 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Image</label>
            </div>
            @if(!empty($lesson['image']))
                <img class="mx-auto col-span-1 w-16 h-16" src="{{ $lesson['image']->temporaryUrl() }}">
            @endif
        </div>

        @error('lesson.image') <span class="error text-red-500 text-sm">{{ $message }}</span> @enderror
        <div class="mt-6 my-3">
            <div class="flex items-center pl-4 border border-gray-200 rounded dark:border-gray-700">
                <input checked wire:model="lesson.difficulty" id="easy" value="easy" type="radio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label for="easy" class="w-full py-4 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Easy</label>
            </div>
            <div class="flex items-center pl-4 border border-gray-200 rounded dark:border-gray-700">
                <input wire:model="lesson.difficulty" id="medium" value="medium" type="radio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label for="medium" class="w-full py-4 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Medium</label>
            </div>
            <div class="flex items-center pl-4 border border-gray-200 rounded dark:border-gray-700">
                <input wire:model="lesson.difficulty" id="hard" value="hard" type="radio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label for="hard" class="w-full py-4 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Hard</label>
            </div>
        </div>
        @for($i = 0; $i < $number_lesson_steps; $i++)
            <div class="relative z-0 w-full mb-3 group">
                <div class="inline-flex items-center justify-center w-full">
                    <hr class="w-64 h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">
                    <span class="absolute px-3 font-medium text-gray-900 -translate-x-1/2 bg-white left-1/2 dark:text-white dark:bg-gray-900">Step {{$i + 1}}</span>
                </div>
                <div class="relative z-0 w-full mb-3 group">
                    <input wire:model="lesson_steps.{{$i}}.sub_title" id="step{{$i}}_sub_title" type="text" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                    <label for="step{{$i}}_sub_title" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Subtitle</label>
                </div>
                @error('lesson_steps.' . $i .'.sub_title') <span class="error text-red-500 text-sm">{{ $message }}</span> @enderror
                <div class="mt-6 relative z-0 w-full mb-3 group">
                    <input wire:model="lesson_steps.{{$i}}.duration" id="step{{$i}}_duration" type="number" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                    <label for="step{{$i}}_duration" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Estimated time (min.)</label>
                    @error('lesson_steps.' . $i . '.duration') <span class="error text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                <div class="mt-6 relative z-0 w-full mb-3 group">
                    <label for="step{{$i}}_description" class="block mb-2 text-sm text-gray-900 dark:text-white">Your description</label>
                    <textarea wire:model="lesson_steps.{{$i}}.description" id="step{{$i}}_description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write the description of your lesson..."></textarea>
                    @error('lesson_steps.' . $i . '.description') <span class="error text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                <div class="mt-6 relative z-0 w-full mb-3 group">
                    <label class="block mb-2 text-sm text-gray-900 dark:text-white">Choose Video (10MB max)</label>
                    <input wire:model="lesson_steps.{{$i}}.video" type="file" name="video">
                    @error('lesson_steps.'. $i .'.video') <span class="error">{{ $message }}</span> @enderror
                </div>
            </div>
        @endfor

        <button wire:click="addStep" type="button" class="mt-3 bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 border-b-4 border-blue-700 hover:border-blue-400 rounded">
            Add step
        </button>
        @if(!empty($lesson_steps))
            <button wire:click="createLesson" type="button" class="mt-3 bg-green-500 hover:bg-green-400 text-white font-bold py-2 px-4 border-b-4 border-green-700 hover:border-green-400 rounded">
                Create lesson
            </button>
        @endif
    </form>
</div>