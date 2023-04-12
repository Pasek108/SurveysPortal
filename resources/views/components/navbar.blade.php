<nav class="p-4 bg-blue-700 font-bold text-white">
    <div class="flex flex-row justify-between md:justify-center items-center max-w-screen-xl mx-auto">
        <a href="/search" class="hidden md:block px-2">
            <i class="fa-solid fa-magnifying-glass mr-2"></i>
            Search for survey
        </a>

        <div class="absolute logo-container text-center">
            <a href="/" class="text-2xl">
                <i class="fa-solid fa-check-to-slot"></i>
                SurveysPortal
            </a>
        </div>

        <ul class="flex grow flex-row justify-end items-center justify-self-end space-x-1">
            @auth
                <li class="hidden md:block px-2">
                    <a href="/users/{{ Auth::user()->name }}">
                        <i class="fa-solid fa-circle-user mr-2"></i>
                        Profile
                    </a>
                </li>
                <li class="hidden md:block px-2">
                    <form method="POST" action="/logout" class="inline">
                        @csrf
                        <button type="submit">
                            <i class="fa-solid fa-arrow-right-from-bracket mr-2"></i>
                            Logout
                        </button>
                    </form>
                </li>
            @else
                <li class="hidden md:block px-2">
                    <a href="/login">
                        <i class="fa-solid fa-arrow-right-to-bracket mr-2"></i>
                        Sign in
                    </a>
                </li>
            @endauth
        </ul>

        <!-- ----------------- menu for mobile ----------------- -->
        <div class="relative md:hidden">
            <button class="px-2" id="mobile-menu-button">
                <i class="fa-solid fa-caret-down mr-2"></i>
                Menu
            </button>

            <ul class="absolute top-7 right-0 hidden p-2 rounded-md bg-zinc-800" id="mobile-menu">
                <li class="p-1 whitespace-nowrap">
                    <a href="/search">
                        <i class="fa-solid fa-magnifying-glass mr-2"></i>
                        Search for survey
                    </a>
                </li>
                @auth
                    <li class="p-1 whitespace-nowrap">
                        <a href="/users/{{ Auth::user()->name }}">
                            <i class="fa-solid fa-circle-user mr-2"></i>
                            Profile
                        </a>
                    </li>
                    <li class="p-1 whitespace-nowrap">
                        <form method="POST" action="/logout" class="inline">
                            @csrf
                            <button type="submit">
                                <i class="fa-solid fa-arrow-right-from-bracket mr-2"></i>
                                Logout
                            </button>
                        </form>
                    </li>
                @else
                    <li class="p-1 whitespace-nowrap">
                        <a href="/login">
                            <i class="fa-solid fa-arrow-right-to-bracket mr-2"></i>
                            Sign in
                        </a>
                    </li>
                @endauth

            </ul>
        </div>
    </div>
</nav>

<script>
    const mobile_menu_button = document.querySelector('#mobile-menu-button');
    const mobile_menu = document.querySelector('#mobile-menu');

    mobile_menu_button.addEventListener('click', () => mobile_menu.classList.toggle('hidden'));
    document.addEventListener("scroll", () => mobile_menu.classList.add('hidden'));
    document.addEventListener("click", (evt) => {
        if (mobile_menu.contains(evt.target) || mobile_menu_button.contains(evt.target)) return;
        mobile_menu.classList.add('hidden')
    });
</script>
