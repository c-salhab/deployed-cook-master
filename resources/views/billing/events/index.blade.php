<x-billing-layout>

    <div class="container w-full px-5 py-6 mx-auto">
        @if(session('success'))
            <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800" role="alert">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
                {{ session('error') }}
            </div>
        @endif
    </div>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg bg-white">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Event Name
                </th>
                <th scope="col" class="px-6 py-3">
                    Description
                </th>
                <th scope="col" class="px-6 py-3">
                   Start Time
                </th>
                <th scope="col" class="px-6 py-3">
                    End Time
                </th>
                <th scope="col" class="px-6 py-3">
                    Cancel Presence
                </th>
            </tr>
            </thead>

            <tbody>
            @foreach($events as $event)
                @if(now() < $event->end_time)
                    <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                        <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $event->name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $event->description }}
                        </td>
                        <td class="px-6 py-4">
                            {{ date('Y-m-d', strtotime($event->start_time)) }}
                        </td>
                        <td class="px-6 py-4">
                            {{ date('Y-m-d', strtotime($event->end_time)) }}
                        </td>

                        <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <div class="flex space-x-2">
                                <form action="{{ route('events.cancel', $event->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to cancel this reservation?')">
                                    @csrf
                                    <button type="submit" class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg text-white">
                                        Cancel Reservation
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endif
            @endforeach
            </tbody>
        </table>
    </div>
</x-billing-layout>
