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
                                    <div class="w-40 p-1 text-xs font-medium leading-none text-center text-blue-100 bg-blue-600 rounded-full">
                                        Step 1</div>
                                </div>

                                <form method="POST" action="{{ route('management.events.store.step-one') }}" enctype="multipart/form-data">
                                    @csrf
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
                                        <label for="address" class="block text-sm font-medium text-gray-700"> Address </label>
                                        <div class="mt-1">
                                            <input type="text" id="address" name="address" class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                        </div>
                                    </div>
                                    @error('address')
                                    <div class="text-sm text-red-400">{{ $message }}</div>
                                    @enderror

                                    <div class="sm:col-span-6">
                                        <label for="max_capacity" class="block text-sm font-medium text-gray-700"> Max Capacity </label>
                                        <div class="mt-1">
                                            <input type="text" id="max_capacity" name="max_capacity" class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                        </div>
                                    </div>
                                    @error('max_capacity')
                                    <div class="text-sm text-red-400">{{ $message }}</div>
                                    @enderror

                                    <div class="sm:col-span-6">
                                        <label for="type" class="block text-sm font-medium text-gray-700">Type</label>
                                        <div class="mt-1">
                                            <select id="type" name="type" class="block w-full bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                                                <option value="WorkShop">WorkShop</option>
                                                <option value="Event">Event</option>
                                            </select>
                                        </div>
                                        @error('type')
                                        <div class="text-sm text-red-400">{{ $message }}</div>
                                        @enderror
                                    </div>

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