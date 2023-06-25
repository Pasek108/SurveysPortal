@php
    $notifications = [
        'messages' => 0,
        'reports' => 23,
        'contact' => 167,
    ];
@endphp

@extends('layouts.layout')

@section('title', 'Admin dashboard')

@section('content')
    <section class="w-full">
        <div class="relative flex flex-col items-start max-w-screen-xl mx-auto md:flex-row">
            <div class="sticky top-0 z-10 w-60 md:w-1/3 lg:w-1/4">
                <x-admin-nav active_page="admins" :notifications="$notifications" />
            </div>
            <div class="flex flex-col w-full p-5 md:w-2/3 lg:w-3/4 min-h">
                <h2 class="mt-10 mb-10 text-3xl font-bold text-center md:mt-0">Admins Management</h2>

                <div class="">
                    <div class="flex flex-wrap items-center justify-between mb-2">
                        <h3 class="text-2xl font-bold">Admins table</h3>
                        <button class="px-3 py-1.5 rounded-md bg-green-700 hover:bg-green-800 text-white font-bold">
                            <i class="mr-1 fa-solid fa-plus"></i>
                            Create new admin
                        </button>
                    </div>

                    <div class="w-full overflow-x-auto">
                        <table class="w-full mx-auto overflow-hidden rounded-md">
                            <thead>
                                <tr class="text-left text-white divide-x bg-slate-800">
                                    <th class="px-4 py-2 whitespace-nowrap">actions</th>
                                    <th class="px-4 py-2 whitespace-nowrap">
                                        id
                                        <i class="ml-1 text-sm cursor-pointer fa-solid fa-arrow-down-short-wide"></i>
                                    </th>
                                    <th class="px-4 py-2 whitespace-nowrap">
                                        name
                                        <i class="ml-1 text-sm cursor-pointer fa-solid fa-sort"></i>
                                    </th>
                                    <th class="px-4 py-2 whitespace-nowrap">
                                        email
                                        <i class="ml-1 text-sm cursor-pointer fa-solid fa-sort"></i>
                                    </th>
                                    <th class="px-4 py-2 whitespace-nowrap">
                                        password
                                        <i class="ml-1 text-sm cursor-pointer fa-solid fa-sort"></i>
                                    </th>
                                    <th class="px-4 py-2 whitespace-nowrap">
                                        role
                                        <i class="ml-1 text-sm cursor-pointer fa-solid fa-sort"></i>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @for ($i = 0; $i < 10; $i++)
                                    <tr class="text-left bg-zinc-100 even:bg-gray-300 ">
                                        <td class="px-4 py-2 whitespace-nowrap">
                                            <button class="px-1.5 rounded-md bg-blue-700 hover:bg-blue-800 text-white font-bold whitespace-nowrap">
                                                <i class="fa-solid fa-pen"></i>
                                                edit
                                            </button>
                                            <button class="px-1.5 rounded-md bg-red-700 hover:bg-red-800 text-white font-bold whitespace-nowrap">
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

@endsection
