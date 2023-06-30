<x-provider-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="flex justify-end m-2 p-2">
        <a href="{{ route('provider.certifications.create') }}" class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg text-white">New Certification</a>
    </div>

    <div class="container flex">
        <button onclick="window.location.href = '{{ route('provider.certifications.index') }}'" class="bg-indigo-500 text-white active:bg-indigo-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button">
            <svg class="w-6 h-6 text-gray-800 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 8 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 1 1.3 6.326a.91.91 0 0 0 0 1.348L7 13"/>
            </svg>
        </button>
        <div class="relative">
            <form action="{{ route('provider.certifications.search') }}" method="POST">
                @csrf
                <input type="text" name="query" class="w-50 pr-8 pl-5 rounded z-0 focus:shadow focus:outline-none" placeholder="Search Certification...">
            </form>
            <div class="absolute top-4 right-3">
                <i class="fa fa-search text-gray-400 z-20 hover:text-gray-500"></i>
            </div>
        </div>
    </div><br>


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

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg bg-white dark:bg-black">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Name
                </th>
                <th scope="col" class="px-6 py-3">
                    Description
                </th>
                <th scope="col" class="px-6 py-3">
                    Formation
                </th>
                <th scope="col" class="px-6 py-3">
                    Generate Certification
                </th>
                <th scope="col" class="px-6 py-3">
                    Edit Certification
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($certifications as $certification)
                <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $certification->name }}
                    </th>
                    <td class="px-6 py-4">
                        {{ $certification->description }}
                    </td>
                    <td class="px-6 py-4">
{{--                        {{ $certification->formation->name }}--}}
                    </td>
                    <td class="px-6 py-4">
                        <div class="container">
                            <div class="interior">
                                <a class="btn px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg text-white" href="#open-modal">Generate Certification</a>
                            </div>
                        </div>
                        <div id="open-modal" class="modal-window">
                            <div>
                                <a href="" title="Close" class="modal-close">Close</a>
                                <h1>Enter the Full Name of the Student</h1><br>
                                <form method="POST" action="{{ route('provider.certifications.generate-pdf', $certification->id) }}" enctype="multipart/form-data">
                                @csrf
                                    <div class="sm:col-span-6">
                                        <label for="first_name" class="block text-sm font-medium text-gray-700"> First Name </label>
                                        <div class="mt-1">
                                            <input type="text" id="first_name" name="first_name" class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                        </div>
                                    </div>
                                    @error('first_name')
                                    <div class="text-sm text-red-400">{{ $message }}</div>
                                    @enderror

                                    <div class="sm:col-span-6">
                                        <label for="last_name" class="block text-sm font-medium text-gray-700"> Last Name </label>
                                        <div class="mt-1">
                                            <input type="text" id="last_name" name="last_name" class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                        </div>
                                    </div>
                                    @error('last_name')
                                    <div class="text-sm text-red-400">{{ $message }}</div>
                                    @enderror
                                    <div class="mt-6 p-4">
                                        <button type="submit" class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg text-white" onclick="event.stopPropagation()">Generate</button>

                                    </div>
                                </form>
                            </div>
                        </div>
                    </td>

                    <script>
                        // Prevent modal closing when clicking inside the modal window
                        document.getElementById('open-modal').addEventListener('click', function(event) {
                            event.stopPropagation();
                        });
                    </script>

                    <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <div class="flex space-x-2">
                            <a href="{{ route('provider.certifications.edit', $certification->id) }}" class="px-4 py-2 bg-green-500 hover:bg-green-700 rounded-lg text-white">Edit</a>
                            <form class="px-4 py-2 bg-red-500 hover:bg-red-700 rounded-lg text-white"
                                  method="POST"
                                  action="{{ route('provider.certifications.destroy', $certification->id) }}"
                                  onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <style>
        .modal-window {
            position: fixed;
            background-color: rgba(255, 255, 255, 0.25);
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            z-index: 999;
            visibility: hidden;
            opacity: 0;
            pointer-events: none;
            transition: all 0.3s;
        &:target {
             visibility: visible;
             opacity: 1;
             pointer-events: auto;
         }
        & > div {
              width: 400px;
              position: absolute;
              top: 50%;
              left: 50%;
              transform: translate(-50%, -50%);
              padding: 2em;
              background: white;
          }
        header {
            font-weight: bold;
        }
        h1 {
            font-size: 150%;
            margin: 0 0 15px;
        }
        }

        .modal-close {
            color: #aaa;
            line-height: 50px;
            font-size: 80%;
            position: absolute;
            right: 0;
            text-align: center;
            top: 0;
            width: 70px;
            text-decoration: none;
        &:hover {
             color: black;
         }
        }

    </style>

</x-provider-layout>

