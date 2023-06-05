@php
    $notifications = [
        'messages' => 0,
        'reports' => 23,
        'contact' => 167,
    ];
@endphp

<x-layout title="Manage admins" show_contact="false">
    <section class="w-full">
        <div class="relative flex flex-col md:flex-row items-start max-w-screen-xl mx-auto">
            <div class="sticky top-0 z-10 w-60 md:w-1/3 lg:w-1/4">
                <x-admin-nav active_page="admins" :notifications="$notifications" />
            </div>
            <div class="flex flex-col w-full md:w-2/3 lg:w-3/4 min-h p-5">
                <h2 class="mb-10 mt-10 md:mt-0 text-3xl font-bold text-center">Admins Management</h2>

                <div class="">
                    <div class="flex flex-wrap justify-between items-center mb-2">
                        <h3 class="text-2xl font-bold">Admins table</h3>
                        <button class="px-3 py-1.5 rounded-md bg-green-700 hover:bg-green-800 text-white font-bold">
                            <i class="fa-solid fa-plus mr-1"></i>
                            Create new admin
                        </button>
                    </div>

                    <div class="w-full overflow-x-auto">
                        <table class="w-full mx-auto rounded-md overflow-hidden">
                            <thead>
                                <tr class="divide-x bg-slate-800 text-white text-left">
                                    <th class="px-4 py-2 whitespace-nowrap">actions</th>
                                    <th class="px-4 py-2 whitespace-nowrap">
                                        id
                                        <i class="fa-solid fa-arrow-down-short-wide ml-1 text-sm cursor-pointer"></i>
                                    </th>
                                    <th class="px-4 py-2 whitespace-nowrap">
                                        name
                                        <i class="fa-solid fa-sort ml-1 text-sm cursor-pointer"></i>
                                    </th>
                                    <th class="px-4 py-2 whitespace-nowrap">
                                        email
                                        <i class="fa-solid fa-sort ml-1 text-sm cursor-pointer"></i>
                                    </th>
                                    <th class="px-4 py-2 whitespace-nowrap">
                                        password
                                        <i class="fa-solid fa-sort ml-1 text-sm cursor-pointer"></i>
                                    </th>
                                    <th class="px-4 py-2 whitespace-nowrap">
                                        role
                                        <i class="fa-solid fa-sort ml-1 text-sm cursor-pointer"></i>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @for ($i = 0; $i < 10; $i++)
                                    <tr class="bg-zinc-200 even:bg-gray-400 text-left ">
                                        <td class="px-4 py-2  whitespace-nowrap">
                                            <button
                                                class="px-1.5 rounded-md bg-blue-700 hover:bg-blue-800 text-white font-bold whitespace-nowrap">
                                                <i class="fa-solid fa-pen"></i>
                                                edit
                                            </button>
                                            <button
                                                class="px-1.5 rounded-md bg-red-700 hover:bg-red-800 text-white font-bold whitespace-nowrap">
                                                <i class="fa-solid fa-trash"></i>
                                                delete
                                            </button>
                                        </td>
                                        <td class="px-4 py-2">{{ $i }}</td>
                                        <td class="px-4 py-2">admin{{ $i }}</td>
                                        <td class="px-4 py-2">admin{{ $i }}{{ '@' }}mail.com</td>
                                        <td class="px-4 py-2">admin{{ $i }}_password</td>
                                        <td class="px-4 py-2">sam</td>
                                    </tr>
                                @endfor
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layout>
