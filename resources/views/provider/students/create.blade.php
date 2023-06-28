<x-provider-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="flex m-2 p-2">
        <a href="{{route('provider.students.index')}}" class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg text-white">Go Back</a>
    </div>

    <div class="m-2 p-2 bg-slate-100 rounded bg-white dark:bg-black">
    <div class="space-y-8 divide-y divide-gray-200 w-1/2 mt-10">
        <form method="POST" action="{{ route('provider.students.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="sm:col-span-6">
                <label for="first_name" class="block text-sm font-medium text-gray-700"> First Name </label>
                <div class="mt-1">
                    <input type="text" id="first_name" name="first_name" class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                </div>
            </div>
            @error('first_name')
            <div class="text-sm text-red-400">{{ $message }}</div>
            @enderror

            <div class="sm:col-span-6">
                <label for="last_name" class="block text-sm font-medium text-gray-700"> Last Name </label>
                <div class="mt-1">
                    <input type="text" id="last_name" name="last_name" class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                </div>
            </div>
            @error('last_name')
            <div class="text-sm text-red-400">{{ $message }}</div>
            @enderror

            <div class="sm:col-span-6">
                <label for="email" class="block text-sm font-medium text-gray-700"> Email </label>
                <div class="mt-1">
                    <input type="text" id="email" name="email" class="block w-full  appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                </div>
            </div>
            @error('email')
            <div class="text-sm text-red-400">{{ $message }}</div>
            @enderror

            <div class="sm:col-span-6">
                <label for="phone" class="block text-sm font-medium text-gray-700"> Phone </label>
                <div class="mt-1">
                    <input type="text" id="phone" name="phone" class="block w-full  appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                </div>
            </div>
            @error('phone')
            <div class="text-sm text-red-400">{{ $message }}</div>
            @enderror

            <div class="sm:col-span-6">
                <label for="address" class="block text-sm font-medium text-gray-700"> Address </label>
                <div class="mt-1">
                    <input type="text" id="address" name="address" class="block w-full  appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                </div>
            </div>
            @error('address')
            <div class="text-sm text-red-400">{{ $message }}</div>
            @enderror

            <div class="mt-6 p-4">
            <button type="submit" class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg text-white">Create New Student</button>
            </div>
        </form>
    </div>

    </div>

</x-provider-layout>




