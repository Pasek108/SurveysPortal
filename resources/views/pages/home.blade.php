<x-layout title="" show_contact="true">
    @auth('web')
        You're a user!
    @endauth

    @auth('admin')
        You're an administrator!
    @endauth

    @guest
        You're not logged in!
    @endguest

    <div class="flex flex-col justify-center items-center">
        <section class="w-full p-4 py-10">
            <div class="flex md:flex-row flex-col justify-center p-5 max-w-screen-xl mx-auto">
                <div class="w-4/5 mb-10 md:mb-0 md:mr-10 text-center">
                    <h2 class="mb-4 text-4xl font-bold">Vertically centered hero sign-up form</h2>
                    <p class="text-xl mb-6">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                        sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                        Pellentesque adipiscing commodo elit at imperdiet dui accumsan.
                    </p>
                    <div class="flex justify-center items-center space-x-2">
                        <a href="/login"
                        class="bg-transparent hover:bg-green-700 text-green-700 font-semibold hover:text-white py-2 px-4 border border-green-500 hover:border-transparent rounded"
                        type="submit">Sign in</a>
                        <a href="/create-survey"
                        class="bg-transparent hover:bg-green-700 text-green-700 font-semibold hover:text-white py-2 px-4 border border-green-500 hover:border-transparent rounded"
                        type="submit">Create survey</a>
                    </div>

                </div>
            </div>
        </section>

        <section class="w-full p-4 py-10">
            <div class="flex md:flex-row flex-col p-5 max-w-screen-xl mx-auto">
                <div class="md:w-1/2 mb-10 md:mb-0 md:mr-10">
                    <h2 class="mb-4 text-4xl font-bold">Vertically centered hero sign-up form</h2>
                    <p class="text-xl">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                        sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                        Pellentesque adipiscing commodo elit at imperdiet dui accumsan.
                    </p>
                </div>

                <form class="md:w-1/2 p-3 border rounded-md border-gray-600">
                    <div class="mb-3">
                        <label class="block mb-1" for="floatingInput">Email address</label>
                        <input class="px-3 py-1.5 w-full border rounded-md border-gray-600" type="email"
                            class="form-control" id="floatingInput" placeholder="name@example.com">
                    </div>

                    <div class="mb-3">
                        <label class="block mb-1" for="floatingPassword">Password</label>
                        <input class="px-3 py-1.5 w-full border rounded-md border-gray-600" type="password"
                            class="form-control" id="floatingPassword" placeholder="Password">
                    </div>


                    <div class="mb-3">
                        <input class="inline" type="checkbox" value="remember-me" id="remember-me">
                        <label class="inline" for="remember-me">Remember me</label>
                    </div>

                    <button
                        class="w-full bg-transparent hover:bg-green-700 text-green-700 font-semibold hover:text-white py-2 px-4 border border-green-500 hover:border-transparent rounded"
                        type="submit">Sign up</button>
                </form>
            </div>
        </section>

        <section class="w-full p-4 py-10 bg-slate-200">
            <div class="flex flex-col items-center justify-center p-5 max-w-screen-xl mx-auto">
                <h2 class="mb-4 text-4xl text-center font-bold">Check the most popular surveys</h2>

                <div class="flex flex-row flex-wrap">
                    @foreach ($surveys as $survey)
                        <div class="flex flex-col grow m-2 md:w-1/3 p-4 border border-gray-400 rounded-md bg-white">
                            <a href="/survey/{{ $survey['name'] }}"
                                class="mb-2 text-xl font-bold overflow-hidden whitespace-nowrap text-ellipsis cursor-pointer hover:underline">{{ $survey['title'] }}</a>

                            <p class="w-full h-[4.75rem] line-clamp-3 text-ellipsis text-justify overflow-hidden">
                                {{ $survey['description'] }}</p>

                            <p class="text-neutral-500">{{ $survey->respondents }} respondents</p>

                            <x-survey-tags :tags="$survey->tags" />
                        </div>
                    @endforeach
                </div>

                <a href="/search" class="mt-8 text-xl text-blue-600 hover:underline">Click here to see more...</a>
            </div>
        </section>
    </div>
</x-layout>
