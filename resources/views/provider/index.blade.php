<x-provider-layout>
    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <p class="text-2xl">
                Hello, <div class="text-indigo-600 text-3xl"><?php echo ucfirst(Auth::user()->first_name); ?></div>
            <br><i>Welcome to our Laravel-based management page, designed exclusively for you.
                This platform empowers you to efficiently manage your courses and students and certifications, and other essential tasks. Take
                advantage of our user-friendly interface to seamlessly navigate through various features. We strive to provide you with a hassle-free experience,
                ensuring optimal control and productivity. Enjoy the convenience and make the most out of your management journey with us.</i>
            </p>
        </div>
    </div>
</x-provider-layout>