<x-guest-layout>
    <section class="px-2 py-32 bg-white md:px-0" style="padding-top: 2rem;
    padding-bottom: 0rem;">
        <div class="body container items-center max-w-6xl px-8 mx-auto xl:px-5" style="padding-bottom: 0rem;">

            <h3 class="text-xl"><i>OUR STORY<br></i>
            </h3>
            <h2 class="text-4xl text-green-600">Welcome<br><br></h2>
            <p style="font-size: 1rem; line-height: 30px;">
                We are a chain of event spaces located in Paris, dedicated to cooking and gastronomy.
                At YourCookMaster, we believe in the power of warm hospitality and providing our clients with a diverse range of services.
                Whether you are looking to learn how to cook delicious meals, discover new savory recipes or indulge in the art of pastry-making,
                we have something for everyone. <br>
                Our team of professionals conducts on-site workshops, lively in-home cooking classes, and online cooking lessons. We also offer a selection of high-quality
                kitchen equipment for sale, organize tastings of organic products sourced from local suppliers, provide fully equipped rental spaces, offer professional
                training for career transitions into the culinary industry, and deliver gourmet meals straight to your doorstep. Additionally, we offer real-time messaging
                support with our chefs to assist you during your home cooking experiences.
                <br><br>

            </p>
            <div class="row">
                <div class="column">
                    <img src="{{ asset('images/about-us.jpg') }}" alt="Snow" style="width:100%">
                </div>
                <div class="column">
                    <img src="{{ asset('images/about-us-2.jpg') }}" alt="Forest" style="width:100%">
                </div>
                <div class="column">
                    <img src="{{ asset('images/about-us-3.jpg') }}" alt="Mountains" style="width:100%">
                </div>
            </div>
            <p><br></p>
        </div>
    </section>
    <style>
        * {
            box-sizing: border-box;
        }
        .body {
            padding: 0;
            box-sizing: border-box;
        }
        .column {
            float: left;
            width: 33.33%;
            padding: 5px;
        }

        /* Clearfix (clear floats) */
        .row::after {
            content: "";
            clear: both;
            display: table;
        }
    </style>
</x-guest-layout>
