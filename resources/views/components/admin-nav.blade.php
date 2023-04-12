@props(['active_page', 'notifications'])

@php
    $contact_links = [
        [
            'route' => 'reports',
            'name' => 'Reports',
            'icon' => 'fa-triangle-exclamation',
        ],
        [
            'route' => 'contact',
            'name' => 'Contact',
            'icon' => 'fa-envelope',
        ],
    ];
    $management_links = [
        [
            'route' => 'admins',
            'name' => 'Admins',
            'icon' => 'fa-user-secret',
        ],
        [
            'route' => 'users',
            'name' => 'Users',
            'icon' => 'fa-user',
        ],
        [
            'route' => 'bans',
            'name' => 'Bans',
            'icon' => 'fa-ban',
        ],
        [
            'route' => 'surveys',
            'name' => 'Surveys',
            'icon' => 'fa-check-to-slot',
        ],
        [
            'route' => 'tags',
            'name' => 'Tags',
            'icon' => 'fa-tag',
        ],
    ];
@endphp

<div id="open-admin-nav"
    class="absolute top-0 z-10 md:hidden flex flex-col justify-center items-center w-12 h-12 rounded-br-md bg-slate-800 text-white">
    <i class="fa-solid fa-bars text-2xl"></i>
</div>

<div id="admin-nav"
    class="absolute top-0 z-10 md:mt-0 md:static hidden md:flex flex-col w-full p-5 pt-12 md:pt-5 bg-slate-800 text-white h-screen">
    <div id="close-admin-nav"
        class="absolute top-2 right-2 md:hidden flex flex-col justify-center items-center w-12 h-12">
        <i class="fa-solid fa-xmark text-3xl"></i>
    </div>

    <ul class="w-full flex flex-col justify-center flex-wrap">
        <li>
            <a href="/admin-panel/"
                class="relative block w-full p-1.5 font-bold hover:underline {{ $active_page == 'dashboard' ? 'text-lime-500' : '' }}">
                <i class="fa-solid fa-house w-6"></i>
                Dashboard

                @if ($active_page == 'dashboard')
                    <div class="absolute top-1 -left-5 block w-1.5 h-7 bg-lime-500 rounded-r-sm"></div>
                @endif
            </a>
        </li>
        @foreach ($contact_links as $link)
            <li>
                <a href="/admin-panel/{{ $link['route'] }}"
                    class="group relative flex flex-row justify-between items-center w-full p-1.5 pr-0 font-bold {{ $active_page == $link['route'] ? 'text-lime-500' : '' }}">
                    <span class="group-hover:underline">
                        <i class="fa-solid {{ $link['icon'] }} w-6"></i>
                        {{ $link['name'] }}
                    </span>
                    <span class="text-sm px-2 py-0.5 rounded-lg bg-red-600 text-white">{{ $notifications[$link['route']] }}</span>

                    @if ($active_page == $link['route'])
                        <div class="absolute top-1 -left-5 block w-1.5 h-7 bg-lime-500 rounded-r-sm"></div>
                    @endif
                </a>
            </li>
        @endforeach
    </ul>

    <h4 class="mt-4 pb-1 mb-2 border-b border-gray-500 text-lg font-bold ">Management</h4>
    <ul class="w-full flex flex-col justify-center flex-wrap">
        @foreach ($management_links as $link)
            <li>
                <a href="/admin-panel/{{ $link['route'] }}"
                    class="relative block w-full p-1.5 font-bold hover:underline {{ $active_page == $link['route'] ? 'text-lime-500' : '' }}">
                    <i class="fa-solid {{ $link['icon'] }} w-6"></i>
                    {{ $link['name'] }}

                    @if ($active_page == $link['route'])
                        <div class="absolute top-1 -left-5 block w-1.5 h-7 bg-lime-500 rounded-r-sm"></div>
                    @endif
                </a>
            </li>
        @endforeach
    </ul>
</div>

<script>
    const admin_nav = document.querySelector("#admin-nav");
    const open_admin_nav = document.querySelector("#open-admin-nav");
    const close_admin_nav = document.querySelector("#close-admin-nav");

    const showAdminNav = () => admin_nav.classList.remove("hidden");
    const hideAdminNav = () => admin_nav.classList.add("hidden");

    open_admin_nav.addEventListener("click", showAdminNav);
    close_admin_nav.addEventListener("click", hideAdminNav);

    document.addEventListener("click", (evt) => {
        if (admin_nav.contains(evt.target) || open_admin_nav.contains(evt.target)) return;
        hideAdminNav();
    });
</script>
