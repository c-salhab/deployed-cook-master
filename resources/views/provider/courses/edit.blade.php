<x-management-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="flex m-2 p-2">
        <a href="{{route('management.rentals.index')}}" class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg text-white">Go Back</a>
    </div>

    <div class="m-2 p-2 bg-slate-100 rounded">
        <div class="space-y-8 divide-y divide-gray-200 w-1/2 mt-10">
            <form method="POST" action="{{ route('management.rentals.update', $rental->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="sm:col-span-6">
                    <label for="name" class="block text-sm font-medium text-gray-700"> Name </label>
                    <div class="mt-1">
                        <input type="text" id="name" name="name" value="{{ $rental->name }}" class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                    </div>
                    @error('name')
                    <div class="text-sm text-red-400">{{ $message }}</div>
                    @enderror
                </div>
                <div class="sm:col-span-6">
                    <label for="price" class="block text-sm font-medium text-gray-700"> Price </label>
                    <div class="mt-1">
                        <input type="text" value="{{ $rental->price }}"id="price" name="price" class="block w-full  appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                    </div>
                    @error('price')
                    <div class="text-sm text-red-400">{{ $message }}</div>
                    @enderror
                </div>
                <div class="sm:col-span-6">
                    <label for="quantity" class="block text-sm font-medium text-gray-700"> Quantity </label>
                    <div class="mt-1">
                        <input type="text" id="quantity" value="{{ $rental->quantity }}" name="quantity" class="block w-full  appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                    </div>
                    @error('quantity')
                    <div class="text-sm text-red-400">{{ $message }}</div>
                    @enderror
                </div>
                <div class="sm:col-span-6">
                    <label for="state" class="block text-sm font-medium text-gray-700"> State </label>
                    <div class="mt-1">
                        <input type="text" value="{{ $rental->state }}" id="state" name="state" class="block w-full  appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                    </div>
                    @error('state')
                    <div class="text-sm text-red-400">{{ $message }}</div>
                    @enderror
                </div>

                <div class="sm:col-span-6">
                    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                    <div class="mt-1">
                        <select id="status" name="status" class="block w-full bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                            <option value="available" {{ $rental->status === 'available' ? 'selected' : '' }}>Available</option>
                            <option value="not available" {{ $rental->status === 'not_available' ? 'selected' : '' }}>Not Available</option>
                        </select>
                    </div>
                    @error('status')
                    <div class="text-sm text-red-400">{{ $message }}</div>
                    @enderror
                </div>
                <br>
                <div class="sm:col-span-6">
                    <label for="image" class="block text-sm font-medium text-gray-700"> Image </label>
                    <div>
                        <img class="w-32 h-32" src="{{ asset($rental->image) }}">
                    </div>
                    <div class="mt-1">
                        <input type="file" id="image" name="image"
                               class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                    </div>
                    @error('image')
                    <div class="text-sm text-red-400">{{ $message }}</div>
                    @enderror
                </div>

                <div class="sm:col-span-6 pt-5">
                    <label for="description" class="block text-sm font-medium text-gray-700"> Description </label>
                    <div class="mt-1">
                        <textarea id="description" rows="3"  class="shadow-sm focus:ring-indigo-500 appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" name="description">{{ $rental->description }}
                        </textarea>
                    </div>
                    @error('description')
                    <div class="text-sm text-red-400">{{ $message }}</div>
                    @enderror
                </div>

                <div class="sm:col-span-6">
                    <label for="start_time" class="block text-sm font-medium text-gray-700"> Start Time </label>
                    <div class="mt-1">
                        <input type="date" min="<?php echo date('Y-m-d'); ?>" value="{{ $rental->start_time }}" id="start_time" name="start_time" class="block w-full  appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                    </div>
                    @error('start_time')
                    <div class="text-sm text-red-400">{{ $message }}</div>
                    @enderror
                </div>

                <div class="sm:col-span-6">
                    <label for="end_time" class="block text-sm font-medium text-gray-700"> End Time </label>
                    <div class="mt-1">
                        <input type="date" min="<?php echo date('Y-m-d'); ?>" value="{{ $rental->end_time }}" id="end_time" name="end_time" class="block w-full  appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                    </div>
                    @error('end_time')
                    <div class="text-sm text-red-400">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mt-6 p-4">
                    <button type="submit" class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg text-white">Update</button>
                </div>
            </form>
        </div>

    </div>

</x-management-layout>





