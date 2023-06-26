<x-management-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <br>
    <div class="container flex">
        <div class="relative">
            <form action="{{ route('management.events.search_1') }}" method="POST">
                @csrf
                <input type="text" name="query" class="h-14 w-96 pr-8 pl-5 rounded z-0 focus:shadow focus:outline-none" placeholder="Search Event-Material...">
            </form>
            <div class="absolute top-4 right-3">
                <i class="fa fa-search text-gray-400 z-20 hover:text-gray-500"></i>
            </div>
        </div>
    </div>
    <br>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 p-8">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Event
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Materials
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Created by
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Created At
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
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $event->name }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $event->material->name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $event->user->name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ date('Y-m-d', strtotime($event->created_at)) }}
                        </td>

                    </tr>

                @endforeach

                </tbody>
            </table>
    </div>

</x-management-layout>