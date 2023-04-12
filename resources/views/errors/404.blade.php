<x-layout title="Error 404" show_contact="true">
    <div class="flex flex-col justify-center items-center">
        <section class="w-full p-4 py-10">
            <div class="flex flex-col align-center items-center md:w-1/2 w-full max-w-screen-xl mx-auto">
                <img class="absolute -z-10 w-96 text-gray-400" src="/error.png" alt="error_image">

                <h2 class="text-7xl text-red-700 font-bold">404</h2>

                <p class="text-center text-red-700 font-bold">
                    <span class="bg-white">Looks like this page does not exist.</span>
                </p>

                <p class="w-96 max-w-full mb-4 text-center text-red-700 font-bold">
                    <span class="bg-white">Please check the URL again or back to the homepage</span>
                </p>

                <a href="/"
                    class="w-44 mt-52 py-2 px-4 border border-transparent rounded bg-green-600 hover:bg-green-700 text-green-700 font-bold text-white text-center">
                    Back to homepage</a>
            </div>
        </section>
    </div>
</x-layout>
