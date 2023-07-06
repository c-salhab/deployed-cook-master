<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
    <td scope="row" class="mx-auto px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
        @if($pfp != null)
            <img src="{{env('APP_URL') . $pfp}}" alt="{{$name}}" class="rounded-full h-10 w-10 object-cover">
        @else
            None
        @endif
    </td>
    <td class="px-6 py-4">
        {{$name}}
    </td>
    <td class="px-6 py-4">
        {{$email}}
    </td>
    <td class="px-6 py-4">
        {{$role}}
    </td>
    <td class="px-6 py-4">
        {{$createdDate}}
    </td>
    <td class="px-6 py-4 text-right">
        <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
    </td>
    <td class="px-6 py-4 text-right">
        <a href="#" class="font-medium text-red-500 dark:text-red-400 hover:underline">Delete</a>
    </td>
</tr>
