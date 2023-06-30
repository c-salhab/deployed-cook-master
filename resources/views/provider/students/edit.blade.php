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
            <form method="POST" action="{{ route('provider.students.update', $student->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="sm:col-span-6">
                    <label for="first_name" class="block text-sm font-medium text-gray-700"> First Name </label>
                    <div class="mt-1">
                        <input type="text" id="first_name" name="first_name" value="{{ $student->first_name }}" class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                    </div>
                    @error('first_name')
                    <div class="text-sm text-red-400">{{ $message }}</div>
                    @enderror
                </div>
                <div class="sm:col-span-6">
                    <label for="last_name" class="block text-sm font-medium text-gray-700"> Last Name </label>
                    <div class="mt-1">
                        <input type="text" value="{{ $student->last_name }}" id="last_name" name="last_name" class="block w-full  appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                    </div>
                    @error('last_name')
                    <div class="text-sm text-red-400">{{ $message }}</div>
                    @enderror
                </div>

                <div class="sm:col-span-6">
                    <label for="email" class="block text-sm font-medium text-gray-700"> Email </label>
                    <div class="mt-1">
                        <input type="text" value="{{ $student->last_name }}" id="email" name="email" class="block w-full  appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                    </div>
                    @error('email')
                    <div class="text-sm text-red-400">{{ $message }}</div>
                    @enderror
                </div>

                <div class="sm:col-span-6">
                    <label for="address" class="block text-sm font-medium text-gray-700"> Address </label>
                    <div class="mt-1">
                        <input type="text" id="address" value="{{ $student->address }}" name="address" class="block w-full  appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                    </div>
                    @error('address')
                    <div class="text-sm text-red-400">{{ $message }}</div>
                    @enderror
                </div>

                <div class="sm:col-span-6">
                    <label for="phone" class="block text-sm font-medium text-gray-700"> Phone </label>
                    <div class="mt-1">
                        <input type="text" value="{{ $student->phone }}" id="state" name="phone" class="block w-full  appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                    </div>
                    @error('state')
                    <div class="text-sm text-red-400">{{ $message }}</div>
                    @enderror
                </div>

                <div class="sm:col-span-6 pt-5">
                    <label for="formation_name" class="block text-sm font-medium text-gray-700">Formations</label>
                    <div class="mt-1">
                        <select id="formation_name" name="formation_name[]" multiple class="form-multiselect block w-full mt-1 block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                            <option value="">None</option>
                            @foreach ($formations as $formation)
                                @if($formation->validated == 1)
                                    <option value="{{ $formation->id }}">{{ $formation->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    @error('formation_name')
                    <div class="text-sm text-red-400">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mt-6 p-4">
                    <button type="submit" class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg text-white">Update</button>
                </div>
            </form>
        </div>

    </div>

</x-provider-layout>





