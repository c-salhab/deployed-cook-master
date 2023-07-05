<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
        {{$name}}
    </th>
    <td class="px-6 py-4">
        {{$price}}
    </td>
    <td class="px-6 py-4">
        {{$currency}}
    </td>
    <td class="px-6 py-4">
        {{$createdDate}}
    </td>
    <td class="px-6 py-4">
        {{$modifiedDate}}
    </td>
    <td class="px-6 py-4 text-right">
        <a href="{{'/administration/subscriptions/modify/'. $id}}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
    </td>
    <td class="px-6 py-4 text-right">
        <a href="#" class="font-medium text-red-500 dark:text-red-400 hover:underline">Delete</a>
    </td>
</tr>
