<nav class="p-4 text-lg font-bold text-white bg-blue-700">
    <div class="flex flex-row items-center justify-between max-w-screen-xl mx-auto md:justify-center">
        <a href="/survey/search" class="hidden px-2 md:block">
            <i class="mr-2 fa-solid fa-magnifying-glass"></i>
            Search for survey
        </a>

        <div class="absolute text-center logo-container">
            <a href="/" class="text-2xl">
                <i class="fa-solid fa-check-to-slot"></i>
                SurveysPortal
            </a>
        </div>

        <ul class="flex flex-row items-center justify-end space-x-1 grow justify-self-end">
            @auth
                <li class="hidden px-2 md:block">
                    <a href="/profile/{{ Auth::user()->id }}">
                        <i class="mr-2 fa-solid fa-circle-user"></i>
                        Profile
                    </a>
                </li>
                <li class="hidden px-2 md:block">
                    <form method="POST" action="/logout" class="inline">
                        @csrf
                        <button type="submit">
                            <i class="mr-2 fa-solid fa-arrow-right-from-bracket"></i>
                            Logout
                        </button>
                    </form>
                </li>
            @else
                <li class="hidden px-2 md:block">
                    <a href="/login">
                        <i class="mr-2 fa-solid fa-arrow-right-to-bracket"></i>
                        Sign in
                    </a>
                </li>
            @endauth
        </ul>

        <!-- ----------------- menu for mobile ----------------- -->
        <div class="relative md:hidden">
            <button class="px-2" id="mobile-menu-button">
                <i class="mr-2 fa-solid fa-caret-down"></i>
                Menu
            </button>

            <ul class="absolute right-0 z-10 hidden p-2 rounded-md top-7 bg-zinc-800" id="mobile-menu">
                <li class="p-1 whitespace-nowrap">
                    <a href="/survey/search">
                        <i class="mr-2 fa-solid fa-magnifying-glass"></i>
                        Search for survey
                    </a>
                </li>
                @auth
                    <li class="p-1 whitespace-nowrap">
                        <a href="/profile/{{ Auth::user()->id }}">
                            <i class="mr-2 fa-solid fa-circle-user"></i>
                            Profile
                        </a>
                    </li>
                    <li class="p-1 whitespace-nowrap">
                        <form method="POST" action="/logout" class="inline">
                            @csrf
                            <button type="submit">
                                <i class="mr-2 fa-solid fa-arrow-right-from-bracket"></i>
                                Logout
                            </button>
                        </form>
                    </li>
                @else
                    <li class="p-1 whitespace-nowrap">
                        <a href="/login">
                            <i class="mr-2 fa-solid fa-arrow-right-to-bracket"></i>
                            Sign in
                        </a>
                    </li>
                @endauth

            </ul>
        </div>
    </div>
</nav>

<script src="/js/mobile_navbar.js"></script>
