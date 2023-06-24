<x-management-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="flex justify-end m-2 p-2">
        <a href="{{route('management.events.create')}}" class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg text-white">New Event</a>
    </div>
    <div>
        @if(session()->has('danger'))
            <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
                <span class="font-medium"></span> {{ session()->get('danger') }}
            </div>
        @endif

        @if(session()->has('success'))
            <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800" role="alert">
                <span class="font-medium"></span> {{ session()->get('success') }}
            </div>
        @endif

        @if(session()->has('warning'))
            <div class="p-4 mb-4 text-sm text-yellow-700 bg-yellow-100 rounded-lg dark:bg-yellow-200 dark:text-yellow-800" role="alert">
                <span class="font-medium"></span> {{ session()->get('warning') }}
            </div>
        @endif
    </div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Image
                </th>
                <th scope="col" class="px-6 py-3">
                    Name
                </th>
                <th scope="col" class="px-6 py-3">
                    Address
                </th>
                <th scope="col" class="px-6 py-3">
                    Max Capacity
                </th>
                <th scope="col" class="px-6 py-3">
                    Description
                </th>
                <th scope="col" class="px-6 py-3">
                    Price
                </th>
                <th scope="col" class="px-6 py-3">
                    Difficulty
                </th>
                <th scope="col" class="px-6 py-3">
                    Type
                </th>
                <th scope="col" class="px-6 py-3">
                    Start Date
                </th>
                <th scope="col" class="px-6 py-3">
                    End Date
                </th>
                <th scope="col" class="px-6 py-3">
                    Edit Event
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($events as $event)
                @php
                    $endTime = strtotime($event->end_time);
                    $currentTime = strtotime('today');
                    $showButtons = $endTime >= $currentTime;
                @endphp
                <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                    <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <img src="{{ asset($event->image) }}" class="w-16 h-16 rounded">
                    </td>
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $event->name }}
                    </th>
                    <td class="px-6 py-4">
                        {{ $event->address }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $event->max_capacity }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $event->description }}
                    </td>
                    <td class="px-6 py-4">
                        € {{ number_format($event->price, 2, ',', '.') }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $event->difficulty }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $event->type }}
                    </td>
                    <td class="px-6 py-4">
                        {{ date('Y-m-d', strtotime($event->start_time)) }}
                    </td>
                    <td class="px-6 py-4">
                        {{ date('Y-m-d', strtotime($event->end_time)) }}
                    </td>

                    <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <div class="flex space-x-2">
                            <a href="{{ route('management.events.edit', $event->id) }}" class="px-4 py-2 bg-green-500 hover:bg-green-700 rounded-lg text-white">Edit</a>
                            @if ($showButtons)
                                <form class="px-4 py-2 bg-red-500 hover:bg-red-700 rounded-lg text-white"
                                      method="POST"
                                      action="{{ route('management.events.destroy', $event->id) }}"
                                      onsubmit="return confirm('Are you sure?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">Delete</button>
                                </form>
                        </div>
                    </td>
                    </tr>
                    @endif
            @endforeach

            </tbody>
        </table>
    </div>

</x-management-layout>