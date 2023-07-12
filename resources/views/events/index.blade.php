<x-app-layout>

    @yield('scripts')
    <div class="container w-full md:px-40 mx-auto py-20">
        <div class="container flex">
            <button onclick="window.location.href = '{{ route('events.index') }}'" class="bg-indigo-500 text-white active:bg-indigo-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button">
                <svg class="w-6 h-6 text-gray-800 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 8 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 1 1.3 6.326a.91.91 0 0 0 0 1.348L7 13"/>
                </svg>
            </button>
            <div class="relative">
                <form action="{{ route('events.search') }}" method="POST">
                    @csrf
                    <input type="text" name="query" class="w-50 pr-8 pl-5 rounded z-0 focus:shadow focus:outline-none" placeholder="Search Event...">
                </form>
                <div class="absolute top-4 right-3">
                    <i class="fa fa-search text-gray-400 z-20 hover:text-gray-500"></i>
                </div>
            </div>
        </div><br>

        <div class="grid lg:grid-cols-4 gap-y-6">
            @foreach($events as $event)
                @php
                    $endTime = strtotime($event->end_time);
                    $currentTime = strtotime('today');
                    $show = $endTime >= $currentTime;
                @endphp
                @if ($show && $event->max_capacity != 0)
                    <div class="max-w-xs mx-4 mb-2 rounded-lg shadow-lg w-80">
                        <img class="w-full h-48" src="{{ asset($event->image) }}" alt="Image" />
                        <div class="px-6 py-4">
                            <h2 class="mb-3 text-xl font-semibold tracking-tight text-indigo-500 uppercase">{{ $event->name }}</h2>
                            <h4 class="mb-3 text-l font-semibold tracking-tight text-indigo-500">Places Left : {{ $event->places_left }}</h4>
                            <p class="leading-normal text-gray-700">Type : {{ $event->type }}</p>
                            <p class="leading-normal text-gray-700">Difficulty : {{ $event->difficulty }}</p>
                            <p class="leading-normal text-gray-700">Address : {{ $event->address }}@if ($event->room) ({{ $event->room->name }}) @endif</p>
                            <p class="leading-normal text-gray-700">Description : {{ $event->description }}</p>
                            <p class="leading-normal text-gray-500 text-sm">Start Time : {{ date('Y-m-d', strtotime($event->start_time)) }}</p>
                            <p class="leading-normal text-gray-500 text-sm">End Time : {{ date('Y-m-d', strtotime($event->end_time)) }}</p>
                        </div>
                        <div class="flex items-center justify-between p-4">
                            <form action="{{ route('events.register', $event->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg text-white">
                                    Join the event!
                                </button>
                            </form>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</x-app-layout>
