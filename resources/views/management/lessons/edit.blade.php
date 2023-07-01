<x-management-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="flex m-2 p-2">
        <a href="{{route('management.lessons.index')}}" class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg text-white">Go Back</a>
    </div>

    <div class="m-2 p-2 bg-slate-100 rounded bg-white">
        <div class="space-y-8 divide-y divide-gray-200 w-1/2 mt-10">
            <form method="POST" action="{{ route('management.lessons.update', $lesson->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="sm:col-span-6">
                    <label for="image" class="block text-sm font-medium text-gray-700"> Image </label>
                    <div>
                        <img class="w-32 h-32" src="{{ asset($lesson->image) }}">
                    </div>
                    <div class="mt-1">
                        <input type="file" id="image" name="image"
                               class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                    </div>
                    @error('image')
                    <div class="text-sm text-red-400">{{ $message }}</div>
                    @enderror
                </div>

                <div class="sm:col-span-6">
                    <label for="name" class="block text-sm font-medium text-gray-700"> Name </label>
                    <div class="mt-1">
                        <input type="text" id="name" name="name" value="{{ $lesson->name }}" class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                    </div>
                    @error('name')
                    <div class="text-sm text-red-400">{{ $message }}</div>
                    @enderror
                </div>

                <div class="sm:col-span-6 pt-5">
                    <label for="description" class="block text-sm font-medium text-gray-700"> Description </label>
                    <div class="mt-1">
                        <textarea id="description" rows="3"  class="shadow-sm focus:ring-indigo-500 appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" name="description">{{ $lesson->description }}
                        </textarea>
                    </div>
                    @error('description')
                    <div class="text-sm text-red-400">{{ $message }}</div>
                    @enderror
                </div>

                <div class="sm:col-span-6">
                    <label for="price" class="block text-sm font-medium text-gray-700"> Price </label>
                    <div class="mt-1">
                        <input type="text" value="{{ $lesson->price }}"id="price" name="price" class="block w-full  appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                    </div>
                    @error('price')
                    <div class="text-sm text-red-400">{{ $message }}</div>
                    @enderror
                </div>
                <div class="sm:col-span-6">
                    <label for="duration" class="block text-sm font-medium text-gray-700"> Duration </label>
                    <div class="mt-1">
                        <input type="text" id="duration" value="{{ $lesson->duration }}" name="duration" class="block w-full  appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                    </div>
                    @error('duration')
                    <div class="text-sm text-red-400">{{ $message }}</div>
                    @enderror
                </div>
                <div class="sm:col-span-6">
                    <label for="score" class="block text-sm font-medium text-gray-700"> Score </label>
                    <div class="mt-1">
                        <input type="text" value="{{ $lesson->score }}" id="score" name="score" class="block w-full  appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                    </div>
                    @error('score')
                    <div class="text-sm text-red-400">{{ $message }}</div>
                    @enderror
                </div>

                <br>
                <div class="mt-6 p-4">
                    <button type="submit" class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg text-white">Update</button>
                </div>
            </form>
        </div>

    </div>

</x-management-layout>





