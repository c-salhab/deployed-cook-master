<x-management-layout>
    <div class="container w-full px-5 py-6 mx-auto">
        <div class="flex items-center min-h-screen">
            <div class="flex-1 h-full max-w-4xl mx-auto bg-white rounded-lg shadow-xl">
                <div class="flex flex-col md:flex-row">
                    <div class="h-32 md:h-auto md:w-1/2">
                        <img class="object-cover w-full h-full"
                             src="https://cdn.pixabay.com/photo/2021/01/15/17/01/green-5919790__340.jpg" alt="img" />
                    </div>
                    <div class="flex items-center justify-center p-6 sm:p-12 md:w-1/2">
                        <div class="w-full">
                            <h3 class="mb-4 text-xl font-bold text-blue-600">Create Event</h3>

                            <div class="w-full bg-gray-200 rounded-full">
                                <div class="w-60 p-1 text-xs font-medium leading-none text-center text-blue-100 bg-blue-600 rounded-full">
                                    Step 2</div>
                            </div><br>
                            <form method="POST" action="{{ route('management.events.store.step-two') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="sm:col-span-6">
                                    <label for="price" class="block text-sm font-medium text-gray-700"> Price </label>
                                    <div class="mt-1">
                                        <input type="text" id="price" value="{{ old('price') }}"name="price" class="block w-full  appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                    </div>
                                </div>

                                @error('difficulty')
                                <div class="text-sm text-red-400">{{ $message }}</div>
                                @enderror

                                <div class="sm:col-span-6">
                                    <label for="image" class="block text-sm font-medium text-gray-700"> Image </label>
                                    <div class="mt-1">
                                        <input type="file" id="image" name="image" class="block appearance-none bg-white border py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                    </div>
                                </div>
                                @error('image')
                                <div class="text-sm text-red-400">{{ $message }}</div>
                                @enderror

                                <div class="sm:col-span-6 pt-5">
                                    <label for="room_name" class="block text-sm font-medium text-gray-700">Room</label>
                                    <div class="mt-1">
                                        <select id="room_name" value="{{ old('room_name') }}" name="room_name" class="form-multiselect block w-full mt-1 block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                                            <option value="" selected>None</option>
                                            @foreach ($rooms as $room)
                                                <option value="{{ $room->name }}" @selected($room->name == $event->room_name)>
                                                    {{ $room->name }}
                                                    ({{ $room->max_capacity }} Persons)
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('room_name')
                                    <div class="text-sm text-red-400">{{ $message }}</div>
                                    @enderror
                                </div>


                                <br><div class="sm:col-span-6">
                                    <label for="start_time" class="block text-sm font-medium text-gray-700"> Start Time </label>
                                    <div class="mt-1">
                                        <input type="date" value="{{ old('start_time') }}" min="<?php echo date('Y-m-d'); ?>" id="start_time" name="start_time" class="block w-full  appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                    </div>
                                </div>
                                @error('start_time')
                                <div class="text-sm text-red-400">{{ $message }}</div>
                                @enderror

                                <div class="sm:col-span-6">
                                    <label for="end_time" class="block text-sm font-medium text-gray-700"> End Time </label>
                                    <div class="mt-1">
                                        <input type="date" value="{{ old('end_time') }}" min="<?php echo date('Y-m-d'); ?>" id="end_time" name="end_time" class="block w-full  appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                    </div>
                                </div>
                                @error('end_time')
                                <div class="text-sm text-red-400">{{ $message }}</div>
                                @enderror

                                <div class="mt-6 p-4 flex justify-end">
                                    <button type="submit" class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg text-white">Next</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</x-management-layout>
