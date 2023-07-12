<x-app-layout>
    <div class="container w-full md:px-40 mx-auto py-20">
        <h1 class="mb-4 text-3xl font-extrabold text-gray-900 dark:text-white md:text-5xl lg:text-6xl"><span class="text-transparent bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400">Explore Cook Master's</span> Recipes ...</h1><br>

        <div class="container flex">
            <button onclick="window.location.href = '{{ route('recipes.index') }}'" class="bg-indigo-500 text-white active:bg-indigo-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button">
                <svg class="w-6 h-6 text-gray-800 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 8 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 1 1.3 6.326a.91.91 0 0 0 0 1.348L7 13"/>
                </svg>
            </button>
            <div class="relative">
                <form action="{{ route('recipes.search') }}" method="POST">
                    @csrf
                    <input type="text" name="query" class="w-50 pr-8 pl-5 rounded z-0 focus:shadow focus:outline-none" placeholder="Search Recipe...">
                </form>
                <div class="absolute top-4 right-3">
                    <i class="fa fa-search text-gray-400 z-20 hover:text-gray-500"></i>
                </div>
            </div>
        </div><br>

        <div class="md:grid lg:grid-cols-3 md:grid-cols-2 mlg:grid-cols-3 md:gap-10 space-y-5 md:space-y-0 px-10 md:px-0 mx-auto">
            @foreach($recipes as $recipe)
            <div class="bg-white p-6 shadow-md rounded-md">
                <img class="w-full h-32" src="{{ asset($recipe->image) }}" alt="Image" /><br>
                <h3 class="text-xl text-gray-800 font-semibold mb-3">{{ $recipe->name }}</h3>
                <p class="mb-2">{{ $recipe->duration }} minutes to make</p>

                <p class="my-4">Ingredients :</p>
                <pre class="my-4">{{ $recipe->ingredients }}</pre>
                <p class="my-4">Steps :</p>
                <pre class="my-4">{{ $recipe->steps }}</pre>
            </div>
            @endforeach
        </div>
    </div>
</x-app-layout>