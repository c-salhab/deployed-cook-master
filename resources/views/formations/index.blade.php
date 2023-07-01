<x-app-layout>

    @yield('scripts')

    <div class="container w-full px-5 py-6 mx-auto">
        <div class="grid lg:grid-cols-4 gap-y-6">
            @foreach($formations as $formation)
                    <div class="max-w-xs mx-4 mb-2 rounded-lg shadow-lg">
                        <img class="w-full h-48" src="{{ asset($formation->image) }}" alt="Image" />
                        <div class="px-6 py-4">
                            <h2 class="mb-3 text-xl font-semibold tracking-tight text-indigo-500 uppercase">{{ $formation->name }}</h2>
                            <h4 class="mb-3 text-l font-semibold tracking-tight text-indigo-500">Duration : {{ $formation->duration }}</h4>
                            <p class="leading-normal text-gray-700">Descprition : {{ $formation->description }}</p><br>
                            <p class="leading-normal text-gray-700">score : {{ $formation->type }}</p>
                        </div>
                        <div class="flex items-center justify-between p-4">
                            <button class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg text-white">
                                <a href="{{ route('add_formation_to_cart', $formation->name) }}" class="btn btn-primary btn-block text-center" role="button">Join the Formation !</a>
                            </button>
                            <span class="text-xl text-indigo-500">€ {{ number_format($formation->price, 2, ',', '.') }}</span>
                        </div>
                    </div>
            @endforeach
        </div>
    </div>
</x-app-layout>