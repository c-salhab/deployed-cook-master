<div>
    @if($lessons->isEmpty())
        <div class="bg-orange-100 border-l-4 border-orange-500 text-orange-700 p-4" role="alert">
            <p class="font-bold">What ?!</p>
            <p>No lessons has been created by youyet !</p>
        </div>
    @else
        <div class="mt-6 bg-white w-full 2 overflow-hidden shadow-xl sm:rounded-lg">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Title
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Difficulty
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Price
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Created at
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Modified at
                        </th>
                        <th scope="col" class="pr-6 py-3">
                            <span class="sr-only">Modify</span>
                        </th>
                        <th scope="col" class="pr-6 py-3">
                            <span class="sr-only">Delete</span>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($lessons as $lesson)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                {{$lesson->title}}
                            </th>
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{$lesson->difficulty}}
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{$lesson->price}}
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{$lesson->created_at}}
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{$lesson->updated_at}}
                            </td>
                            <td class="pr-6 py-4 text-right">
                                <a href="" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <button wire:click="" class="font-medium text-red-500 dark:text-red-400 hover:underline">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
    <a href="{{route('provider.lessons.create')}}">
        <button class="mt-3 col-span-1 bg-green-500 hover:bg-green-400 text-white font-bold py-2 px-4 border-b-4 border-green-700 hover:border-green-400 rounded">
            Create lesson
        </button>
    </a>
</div>
