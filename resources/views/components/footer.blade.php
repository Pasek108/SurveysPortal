@props(['show_contact'])

<footer class="relative z-20 p-3 bg-gray-700 text-white">
    @if ($show_contact == "true")
        <div class="max-w-screen-xl mx-auto">
            <div class="flex md:flex-row flex-col p-5">
                <div class="md:w-1/2 m-2">
                    <h2 class="mb-4 text-2xl font-bold">Links</h2>
                    <p class="text-xl">Below is an example form built entirely with Bootstrap’s form controls. Each
                        required form
                        group has a validation state that can be triggered by attempting to submit the form without
                        completing it.
                    </p>
                </div>

                <div class="md:w-1/2 m-2">
                    <h2 class="mb-4 text-2xl font-bold">Any problem? Suggestion? Contact us</h2>
                    <form class="p-3 border rounded-md border-gray-300">
                        @csrf
                        <div class="mb-3">
                            <label class="block mb-1" for="email">Email address</label>
                            <input class="px-3 py-1.5 w-full border rounded-md border-gray-600 text-black"
                                type="email" id="email" placeholder="name@example.com">
                        </div>

                        <div class="mb-3">
                            <label class="block mb-1" for="message">Message</label>
                            <textarea class="h-24 px-3 py-1.5 w-full border rounded-md border-gray-600 text-black" id="message"
                                placeholder="your message text"></textarea>
                        </div>

                        <button
                            class="w-full bg-transparent hover:bg-green-700 text-green-500 font-semibold hover:text-white py-2 px-4 border border-green-500 hover:border-transparent rounded"
                            type="submit">Send</button>
                    </form>
                </div>
            </div>
        </div>

        <hr class="max-w-screen-xl mx-auto mb-2 border-t border-gray-300">
    @endif

    <div class="font-bold text-center">Artur Pas 2023</div>
</footer>
