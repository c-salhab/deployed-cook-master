<x-app-layout>

    @yield('scripts')

    <div class="container w-full px-5 py-6 mx-auto">
        <div class="grid lg:grid-cols-4 gap-y-6">
            @foreach($events as $event)
                @php
                    $endTime = strtotime($event->end_time);
                    $currentTime = strtotime('today');
                    $show = $endTime >= $currentTime;
                @endphp
                @if ($show && $event->max_capacity != 0)
                    <div class="max-w-xs mx-4 mb-2 rounded-lg shadow-lg">
                        <img class="w-full h-48" src="{{ asset($event->image) }}" alt="Image" />
                        <div class="px-6 py-4">
                            <h2 class="mb-3 text-xl font-semibold tracking-tight text-indigo-500 uppercase">{{ $event->name }}</h2>
                            <h4 class="mb-3 text-l font-semibold tracking-tight text-indigo-500">Max Capacity : {{ $event->max_capacity }}</h4>
                            <p class="leading-normal text-gray-700">Descprition : {{ $event->description }}</p><br>
                            <p class="leading-normal text-gray-500 text-sm">Start Time : {{ date('Y-m-d', strtotime($event->start_time)) }}</p>
                            <p class="leading-normal text-gray-500 text-sm">End Time : {{ date('Y-m-d', strtotime($event->end_time)) }}</p>
                        </div>
                        <div class="flex items-center justify-between p-4">
                            <button class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg text-white">
                                <a href="{{ route('add_event_to_cart', $event->name) }}" class="btn btn-primary btn-block text-center" role="button">Join the event !</a>
                            </button>
                            <span class="text-xl text-indigo-500">€ {{ number_format($event->price, 2, ',', '.') }}</span>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</x-app-layout>

