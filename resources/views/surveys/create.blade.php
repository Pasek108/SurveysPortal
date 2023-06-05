<x-layout title="Create survey" show_contact="true">
    <div class="flex flex-col justify-center items-center">
        <section class="w-full p-4 py-10">
            <div class="flex flex-col md:w-1/2 w-full max-w-screen-xl mx-auto">
                <form method="POST" action="/auth" id="form"
                    class="group active-1 border rounded-md border-gray-400 bg-slate-100 overflow-hidden">
                    <!-- --------------- section buttons --------------- -->
                    <div class="flex" id="sections">
                        <button type="button"
                            class="grow p-2 border-r group-[:not(.active-1)]:bg-blue-600 group-[:not(.active-1)]:text-white text-center">
                            Informations
                        </button>
                        <button type="button"
                            class="grow p-2 border-r group-[:not(.active-2)]:bg-blue-600 group-[:not(.active-2)]:text-white text-center">
                            Questions
                        </button>
                        <button type="button"
                            class="grow p-2 group-[:not(.active-3)]:bg-blue-600 group-[:not(.active-3)]:text-white text-center">
                            Settings
                        </button>
                    </div>

                    <!-- --------------- informations --------------- -->
                    <section class="p-8 group-[:not(.active-1)]:hidden">
                        <h2 class="mb-2 text-2xl font-bold text-center">Fill informations</h2>

                        <x-input label="Title" type="text" name="title" placeholder="Survey title"
                            required="true" />
                        <x-input label="Start date" type="datetime-local" name="start_date" placeholder="" />
                        <x-input label="End date" type="datetime-local" name="end_date" placeholder="" />

                        <div class="mb-3">
                            <label class="block mb-1" for="description">Description</label>
                            <textarea class="px-4 py-1.5 w-full border rounded border-gray-400" id="description" name="description"
                                placeholder="Survey description" rows="5"></textarea>
                        </div>

                        <div class="flex justify-end space-x-3">
                            <div class="w-1/2"></div>
                            <button type="button"
                                class="next w-1/2 bg-transparent hover:bg-green-700 text-green-700 font-semibold hover:text-white py-2 px-4 border border-green-500 hover:border-transparent rounded">
                                Next
                                <i class="fa-solid fa-arrow-right ml-1 -mr-1"></i>
                            </button>
                        </div>
                    </section>

                    <!-- --------------- questions --------------- -->
                    <section class="p-8 group-[:not(.active-2)]:hidden">
                        <h2 class="mb-2 text-2xl font-bold text-center">Create questions (max 100)</h2>

                        <div class="flex flex-col justify-center items-center py-4">
                            <ul id="questions-list"
                                class="flex flex-col justify-start items-start w-full mb-3 space-y-2">
                                <li class="w-full py-2 px-4 border border-gray-600 rounded-md">
                                    <details class="w-full" open>
                                        <summary class="w-full cursor-pointer">
                                            Question 1
                                            <button>aaa</button>
                                        </summary>

                                        <div class="mb-3">
                                            <label class="block mb-1" for="question">Question</label>
                                            <textarea class="px-4 py-1.5 w-full border rounded border-gray-400" id="question" name="Question"
                                                placeholder="Question text" rows="5"></textarea>
                                        </div>

                                        <div>

                                        </div>
                                    </details>
                                </li>
                            </ul>

                            <button type="button"
                                class="prev w-1/2 bg-transparent hover:bg-green-700 text-green-700 font-semibold hover:text-white py-2 px-4 border border-green-500 hover:border-transparent rounded">
                                <i class="fa-solid fa-plus ml-1 -mr-1"></i>
                                Add question
                            </button>
                        </div>

                        <div class="flex justify-center space-x-3">
                            <button type="button"
                                class="prev w-1/2 bg-transparent hover:bg-green-700 text-green-700 font-semibold hover:text-white py-2 px-4 border border-green-500 hover:border-transparent rounded">
                                <i class="fa-solid fa-arrow-left mr-1 -ml-1"></i>
                                Prev
                            </button>
                            <button type="button"
                                class="next w-1/2 bg-transparent hover:bg-green-700 text-green-700 font-semibold hover:text-white py-2 px-4 border border-green-500 hover:border-transparent rounded">
                                Next
                                <i class="fa-solid fa-arrow-right ml-1 -mr-1"></i>
                            </button>
                        </div>
                    </section>

                    <!-- --------------- settings --------------- -->
                    <section class="p-8 group-[:not(.active-3)]:hidden">
                        <h2 class="mb-2 text-2xl font-bold text-center">Change settings</h2>

                        <x-input label="Admin password" type="password" name="admin-password" placeholder="Password"
                            required="true" />
                        <x-input label="Access password" type="password" name="access-password"
                            placeholder="Password" />
                        <div class="mb-3">
                            <label class="block mb-1" for="end_message">End message</label>
                            <textarea class="px-4 py-1.5 w-full border rounded border-gray-400" id="end_message" name="end_message"
                                placeholder="Survey end message" rows="5">Thanks for taking the survey</textarea>
                        </div>
                        <div class="mb-3">
                            <input class="inline" type="checkbox" value="remember-me" name="remember-me"
                                id="remember-me" value="1">
                            <label class="inline" for="remember-me">Allow not logged users</label>
                        </div>

                        <div class="flex justify-end space-x-3">
                            <button type="button"
                                class="prev w-1/2 bg-transparent hover:bg-green-700 text-green-700 font-semibold hover:text-white py-2 px-4 border border-green-500 hover:border-transparent rounded">
                                <i class="fa-solid fa-arrow-left mr-1 -ml-1"></i>
                                Prev
                            </button>
                            <button type="submit"
                                class="w-1/2 bg-transparent hover:bg-green-700 text-green-700 font-semibold hover:text-white py-2 px-4 border border-green-500 hover:border-transparent rounded">
                                Create survey
                            </button>
                        </div>
                    </section>
                </form>
            </div>
        </section>
    </div>

    <script>
        let active_section = 1;
        const form = document.querySelector("#form");
        const section_buttons = document.querySelectorAll("#sections button");
        const next_buttons = form.querySelectorAll(".next");
        const prev_buttons = form.querySelectorAll(".prev");

        section_buttons.forEach((section, id) => section.addEventListener("click", () => openSection(id + 1)));
        next_buttons.forEach((button, id) => button.addEventListener("click", () => openSection(id + 2)));
        prev_buttons.forEach((button, id) => button.addEventListener("click", () => openSection(id)));

        function openSection(id) {
            form.classList.remove(`active-${active_section}`);
            active_section = id;

            if (active_section < 0) active_section = 0;
            active_section %= section_buttons.length + 1;

            form.classList.add(`active-${active_section}`);
        }
    </script>
</x-layout>
