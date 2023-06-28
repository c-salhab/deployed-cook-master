<x-management-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="flex m-2 p-2">
        <a href="{{route('management.materials.index')}}" class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg text-white">Go Back</a>
    </div>

    <div class="m-2 p-2 bg-slate-100 rounded bg-white dark:bg-black">
    <div class="space-y-8 divide-y divide-gray-200 w-1/2 mt-10">
        <form method="POST" action="{{ route('management.materials.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="sm:col-span-6">
                <label for="image" class="block text-sm font-medium text-gray-700"> Image </label>
                <div class="mt-1">
                    <input type="file" id="image" name="image" class="block appearance-none bg-white border py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                </div>
            </div>
            @error('image')
            <div class="text-sm text-red-400">{{ $message }}</div>
            @enderror


            <div class="sm:col-span-6">
                <label for="name" class="block text-sm font-medium text-gray-700"> Name </label>
                <div class="mt-1">
                    <input type="text" id="name" name="name" class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                </div>
            </div>
            @error('name')
            <div class="text-sm text-red-400">{{ $message }}</div>
            @enderror

            <div class="sm:col-span-6 pt-5">
                <label for="description" class="block text-sm font-medium text-gray-700"> Description </label>
                <div class="mt-1">
                    <textarea id="description" rows="3"  class="shadow-sm focus:ring-indigo-500 appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" name="description"></textarea>
                </div>
            </div>
            @error('description')
            <div class="text-sm text-red-400">{{ $message }}</div>
            @enderror


            <div class="sm:col-span-6">
                <label for="price" class="block text-sm font-medium text-gray-700"> Price </label>
                <div class="mt-1">
                    <input type="text" id="price" name="price" class="block w-full  appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                </div>
            </div>
            @error('price')
            <div class="text-sm text-red-400">{{ $message }}</div>
            @enderror

            <div class="sm:col-span-6">
                <label for="quantity" class="block text-sm font-medium text-gray-700"> Quantity </label>
                <div class="mt-1">
                    <input type="text" id="quantity" name="quantity" class="block w-full  appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                </div>
            </div>
            @error('quantity')
            <div class="text-sm text-red-400">{{ $message }}</div>
            @enderror

            <div class="sm:col-span-6">
                <label for="state" class="block text-sm font-medium text-gray-700"> State </label>
                <div class="mt-1">
                    <input type="text" id="state" name="state" class="block w-full  appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                </div>
            </div>
            @error('state')
            <div class="text-sm text-red-400">{{ $message }}</div>
            @enderror

            <div class="mt-6 p-4">
            <button type="submit" class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg text-white">Create New Material</button>
            </div>
        </form>
    </div>

    </div>

</x-management-layout>




