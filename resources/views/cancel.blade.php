<x-app-layout>

    <div class="h-screen flex items-center justify-center">
        <table class=" text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    You order has been cancelled
                </th>
            </tr>
            </thead>
            <tbody>
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    <i>order cancelled by <?php echo ucfirst(Auth::user()->name); ?></i>
                </th>
            </tr>

            <tr class="bg-white dark:bg-gray-800">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        <a href="{{ route('dashboard') }}" class="btn btn-info"> <i class="fa fa-arrow-left"></i> Continue Shopping</a>
                    </button>
                </th>
            </tr>
            </tbody>
        </table>
    </div>

</x-app-layout>
