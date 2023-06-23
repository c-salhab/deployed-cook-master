<x-management-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <p class="text-2xl">
                Hello, <div class="text-indigo-600 text-3xl"><?php echo ucfirst(Auth::user()->name); ?></div>
            <i>Welcome to our Laravel-based management page, designed exclusively for you.
                This platform empowers you to efficiently manage your events, rentals, and other essential tasks. Take advantage of our user-friendly
                interface to seamlessly navigate through various features. We strive to provide you with a hassle-free experience,
                ensuring optimal control and productivity. Enjoy the convenience and make the most out of your management journey with us.</i>
            </p>

        </div>
    </div>
</x-management-layout>
