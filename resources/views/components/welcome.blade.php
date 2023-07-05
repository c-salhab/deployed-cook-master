<div class="p-6 lg:p-8 bg-white border-b border-gray-200">
    <h1 class="text-2xl font-medium text-gray-900">
        Welcome to Cook Master !
    </h1>
    <p class="mt-6 text-gray-500 leading-relaxed">
        Our application is designed to revolutionize your culinary journey and elevate your cooking skills to new heights. With a wide range of features and functionalities, Cook Master provides a comprehensive platform for learning, exploring, and connecting with the culinary world. Whether you're a passionate home cook, a food enthusiast, or a professional chef, our application offers a seamless experience tailored to your needs.
    </p>
    <p class="mt-1 text-gray-500 leading-relaxed">
        From accessing a diverse array of lessons and certified courses, reserving kitchen spaces, and attending exclusive events to shopping for high-quality products, engaging in a chat service with chefs, and enjoying personalized recommendations, Cook Master is your ultimate companion in the world of gastronomy.
    </p>
    <p class="mt-1 text-gray-500 leading-relaxed">
        Join us today and embark on a delightful culinary adventure that will inspire and empower you in the kitchen. Let your culinary passion thrive with Cook Master!
    </p>
</div>

<div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8 p-6 lg:p-8">
    <div>
        <div class="flex items-center">
            <x-recipes-logo></x-recipes-logo>
            <h2 class="ml-3 text-xl font-semibold text-gray-900">
                <a href="{{ route('recipes.index') }}" >Recipes</a>
            </h2>
        </div>
        <p class="mt-4 text-gray-500 text-sm leading-relaxed">
            Unleash your culinary creativity with our diverse collection of recipes. From traditional classics to innovative creations, our recipe database provides endless inspiration for you to explore, experiment, and savor the flavors of the world.
        </p>
        <p class="mt-4 text-sm">
            <a href="{{ route('recipes.index') }}" class="inline-flex items-center font-semibold text-indigo-700">
                Explore the recipes
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="ml-1 w-5 h-5 fill-indigo-500">
                    <path fill-rule="evenodd" d="M5 10a.75.75 0 01.75-.75h6.638L10.23 7.29a.75.75 0 111.04-1.08l3.5 3.25a.75.75 0 010 1.08l-3.5 3.25a.75.75 0 11-1.04-1.08l2.158-1.96H5.75A.75.75 0 015 10z" clip-rule="evenodd" />
                </svg>
            </a>
        </p>
    </div>

    <div>
        <div class="flex items-center">
            <x-intervention-logo></x-intervention-logo>
            <h2 class="ml-3 text-xl font-semibold text-gray-900">
                <a href="{{ route('lessons.index') }}">Lessons</a>
            </h2>
        </div>

        <p class="mt-4 text-gray-500 text-sm leading-relaxed">
            Experience personalized guidance and support through our intervention services. Our team of experts is here to help you navigate challenges, provide solutions, and empower you to reach your fullest potential.
        </p>
        <p class="mt-4 text-sm">
            <a href="{{ route('lessons.index') }}" class="inline-flex items-center font-semibold text-indigo-700">
                Let's learn incredible skills
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="ml-1 w-5 h-5 fill-indigo-500">
                    <path fill-rule="evenodd" d="M5 10a.75.75 0 01.75-.75h6.638L10.23 7.29a.75.75 0 111.04-1.08l3.5 3.25a.75.75 0 010 1.08l-3.5 3.25a.75.75 0 11-1.04-1.08l2.158-1.96H5.75A.75.75 0 015 10z" clip-rule="evenodd" />
                </svg>
            </a>
        </p>
    </div>

    <div>
        <div class="flex items-center">
            <x-shop-logo></x-shop-logo>
            <h2 class="ml-3 text-xl font-semibold text-gray-900">
                <a href="{{ route('shop.index') }}">Shop</a>
            </h2>
        </div>

        <p class="mt-4 text-gray-500 text-sm leading-relaxed">
            Discover our online store, where you can find a wide selection of quality products. From books and resources to tools and equipment, our boutique offers everything you need to support your learning journey.        </p>
        <p class="mt-4 text-sm">
            <a href="{{ route('shop.index') }}" class="inline-flex items-center font-semibold text-indigo-700">
                Come and buy incredible stuff !
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="ml-1 w-5 h-5 fill-indigo-500">
                    <path fill-rule="evenodd" d="M5 10a.75.75 0 01.75-.75h6.638L10.23 7.29a.75.75 0 111.04-1.08l3.5 3.25a.75.75 0 010 1.08l-3.5 3.25a.75.75 0 11-1.04-1.08l2.158-1.96H5.75A.75.75 0 015 10z" clip-rule="evenodd" />
                </svg>
            </a>
        </p>
    </div>
    <div>
        <div class="flex items-center">
            <x-rentals-logo></x-rentals-logo>
            <h2 class="ml-3 text-xl font-semibold text-gray-900">
                <a href="{{ route('rentals.index') }}">Rentals</a>
            </h2>
        </div>
        <p class="mt-4 text-gray-500 text-sm leading-relaxed">
            Rent our fully equipped kitchen space, ideal for culinary enthusiasts and professionals. Whether you're planning a cooking workshop or need a professional setting for your culinary creations, our kitchen rental service has you covered.        </p>
        <p class="mt-4 text-sm">
            <a href="{{ route('rentals.index') }}" class="inline-flex items-center font-semibold text-indigo-700">
                What can I rent ?
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="ml-1 w-5 h-5 fill-indigo-500">
                    <path fill-rule="evenodd" d="M5 10a.75.75 0 01.75-.75h6.638L10.23 7.29a.75.75 0 111.04-1.08l3.5 3.25a.75.75 0 010 1.08l-3.5 3.25a.75.75 0 11-1.04-1.08l2.158-1.96H5.75A.75.75 0 015 10z" clip-rule="evenodd" />
                </svg>
            </a>
        </p>
    </div>
    <div>
        <div class="flex items-center">
            <x-events-logo></x-events-logo>
            <h2 class="ml-3 text-xl font-semibold text-gray-900">
                <a href="{{ route('events.index') }}">Events</a>
            </h2>
        </div>
        <p class="mt-4 text-gray-500 text-sm leading-relaxed">
            Join us for exclusive events that celebrate food, culture, and learning. From culinary workshops to guest chef demonstrations, our events offer unique experiences and opportunities to connect with fellow enthusiasts.        <p class="mt-4 text-sm">
            <a href="{{ route('events.index') }}" class="inline-flex items-center font-semibold text-indigo-700">
                I would like to attend an event
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="ml-1 w-5 h-5 fill-indigo-500">
                    <path fill-rule="evenodd" d="M5 10a.75.75 0 01.75-.75h6.638L10.23 7.29a.75.75 0 111.04-1.08l3.5 3.25a.75.75 0 010 1.08l-3.5 3.25a.75.75 0 11-1.04-1.08l2.158-1.96H5.75A.75.75 0 015 10z" clip-rule="evenodd" />
                </svg>
            </a>
        </p>
    </div>
    <div>
        <div class="flex items-center">
            <x-cooptation-logo></x-cooptation-logo>
            <h2 class="ml-3 text-xl font-semibold text-gray-900">
                <a href="{{ route('formations.index') }}">Certified courses</a>
            </h2>
        </div>
        <p class="mt-4 text-gray-500 text-sm leading-relaxed">
            Take classes to prepare for an official exam with a renowned chef. After graduating, there's no stopping you from opening your own restaurant.
            <a href="{{ route('formations.index') }}" class="inline-flex items-center font-semibold text-indigo-700">
                Obtain your certified diploma like a chief
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="ml-1 w-5 h-5 fill-indigo-500">
                    <path fill-rule="evenodd" d="M5 10a.75.75 0 01.75-.75h6.638L10.23 7.29a.75.75 0 111.04-1.08l3.5 3.25a.75.75 0 010 1.08l-3.5 3.25a.75.75 0 11-1.04-1.08l2.158-1.96H5.75A.75.75 0 015 10z" clip-rule="evenodd" />
                </svg>
            </a>
        </p>
    </div>
</div>
