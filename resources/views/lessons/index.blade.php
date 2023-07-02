<x-app-layout>

    @yield('scripts')

    <div class="container w-full px-5 py-6 mx-auto">
        <div class="grid lg:grid-cols-4 gap-y-6">
            @foreach($lessons as $lesson)
                    <div class="max-w-xs mx-4 mb-2 rounded-lg shadow-lg">
                        <img class="w-full h-48" src="{{ asset($lesson->image) }}" alt="Image" />
                        <div class="px-6 py-4">
                            <h2 class="mb-3 text-xl font-semibold tracking-tight text-indigo-500 uppercase">{{ $lesson->name }}</h2>
                            <p class="leading-normal text-gray-700">Description : {{ $lesson->description }}</p>
                            <p class="leading-normal text-gray-500 text-sm">Lesson Duration : {{ $lesson->duration }}</p>
                        </div>
                        <div class="flex items-center justify-between p-4">
                            <button class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg text-white">
                                <a href="{{ route('add_lesson_to_cart', $lesson->name) }}" class="btn btn-primary btn-block text-center" role="button">Register for the lesson !</a>
                            </button>
                            <span class="text-xl text-indigo-500">€ {{ number_format($lesson->price, 2, ',', '.') }}</span>
                        </div>
                    </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
