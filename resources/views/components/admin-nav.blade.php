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
    class="absolute top-0 z-10 flex flex-col items-center justify-center w-12 h-12 text-white md:hidden rounded-br-md bg-slate-800">
    <i class="text-2xl fa-solid fa-bars"></i>
</div>

<div id="admin-nav"
    class="absolute top-0 z-10 flex-col hidden w-full h-screen p-5 pt-12 text-white md:mt-0 md:static md:flex md:pt-5 bg-slate-800">
    <div id="close-admin-nav"
        class="absolute flex flex-col items-center justify-center w-12 h-12 top-2 right-2 md:hidden">
        <i class="text-3xl fa-solid fa-xmark"></i>
    </div>

    <ul class="flex flex-col flex-wrap justify-center w-full">
        <li>
            <a href="/admin-panel/"
                class="relative block w-full p-1.5 font-bold hover:underline {{ $active_page == 'dashboard' ? 'text-lime-500' : '' }}">
                <i class="w-6 fa-solid fa-house"></i>
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

    <h4 class="pb-1 mt-4 mb-2 text-lg font-bold border-b border-gray-500 ">Management</h4>
    <ul class="flex flex-col flex-wrap justify-center w-full">
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

<script src="/js/admin_panel.js"></script>
