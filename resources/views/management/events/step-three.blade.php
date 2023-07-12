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
                                <div class="w-100 p-1 text-xs font-medium leading-none text-center text-blue-100 bg-blue-600 rounded-full">
                                    Step 3</div>
                            </div><br>

                            <form method="POST" action="{{ route('management.events.store.step-three') }}" enctype="multipart/form-data">
                                @csrf

                                <div class="sm:col-span-6 pt-5">
                                    <label for="material_name" class="block text-sm font-medium text-gray-700">Material</label>
                                    <div class="mt-1">
                                        <select id="material_name" name="material_name[]" multiple class="form-multiselect block w-full mt-1 block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                                            <option value="">None</option>
                                            @foreach ($materials as $material)
                                            @if($material->quantity > 0)
                                                <option value="{{ $material->id }}">{{ $material->name }} ({{ $material->quantity }} Left)</option>
                                            @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('material_name')
                                    <div class="text-sm text-red-400">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="sm:col-span-6 pt-5">
                                    <label for="quantity" class="block text-sm font-medium text-gray-700">Quantity</label>
                                    <div class="mt-1">
                                        @foreach ($materials as $material)
                                            <input type="number" value="{{ old('quantity') }}" name="quantity[{{ $material->id }}]" value="{{ old('quantity.' . $material->id) }}" min="0" max="{{ $material->quantity }}" class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5"><br>
                                        @endforeach
                                    </div>
                                    @error('quantity')
                                    <div class="text-sm text-red-400">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mt-6 p-4 flex justify-end">
                                    <button type="submit" class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg text-white">Create Event</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-management-layout>