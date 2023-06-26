@php $notifications = ['reports' => $reports_count, 'contact' => $contact_count]; @endphp

@extends('layouts.layout')

@section('title', 'Admin panel - users')

@section('content')
    <section class="w-full">
        <div class="relative flex flex-col items-start max-w-screen-xl mx-auto md:flex-row">
            <div class="sticky top-0 z-10 w-60 md:w-1/3 lg:w-1/4">
                <x-admin-nav active_page="users" :notifications="$notifications" />
            </div>

            <div class="flex flex-col w-full p-5 md:w-2/3 lg:w-3/4 min-h">
                <h2 class="mt-10 text-3xl font-bold text-center md:mt-0">Users Management</h2>

                <div class="mt-10">
                    <div class="flex flex-wrap items-center justify-between mb-2">
                        <h3 class="text-2xl font-bold">Users table</h3>
                    </div>

                    <div class="flex flex-wrap items-center justify-between gap-2 mb-2">
                        <form action="/admin-panel/users" method="GET" class="relative flex flex-row grow">
                            <input name="search" type="text" value="{{ request()->search }}" placeholder="Search by name..." class="px-3 py-1.5 grow border rounded-md border-gray-600 text-black">
                            <input name="sort" type="text" value="{{ request()->sort }}" hidden>
                            <input name="order" type="text" value="{{ request()->order }}" hidden>
                            <input name="user_id" type="text" value="{{ request()->user_id }}" hidden>
                            <button type="submit" class="absolute  h-full right-0 px-3 py-1.5 rounded-tr-md rounded-br-md bg-blue-700 border-gray-600 hover:bg-blue-800 text-white font-bold">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                        </form>
                        <button class="px-3 py-1.5 rounded-md bg-green-700 hover:bg-green-800 text-white font-bold">
                            <i class="fa-solid fa-user-plus"></i>
                            Create new user
                        </button>
                    </div>

                    <div class="w-full overflow-x-auto scroll-visible">
                        <table class="w-full mx-auto overflow-hidden rounded-md">
                            <thead>
                                <tr class="text-left text-white divide-x bg-slate-800">
                                    <th class="w-1 px-4 py-2 whitespace-nowrap">
                                        id
                                        @if ((empty(request()->sort) || request()->sort == 'id') && request()->order == 'DESC')
                                            <a href="{{ url()->current() }}?sort=id&order=ASC&search={{ request()->search }}&user_id={{ request()->user_id }}">
                                                <i class="ml-1 text-sm cursor-pointer fa-solid fa-arrow-up-wide-short"></i>
                                            </a>
                                        @elseif ((empty(request()->sort) || request()->sort == 'id') && request()->order == 'ASC')
                                            <a href="{{ url()->current() }}?sort=id&order=DESC&search={{ request()->search }}&user_id={{ request()->user_id }}">
                                                <i class="ml-1 text-sm cursor-pointer fa-solid fa-arrow-down-short-wide"></i>
                                            </a>
                                        @else
                                            <a href="{{ url()->current() }}?sort=id&order=ASC&search={{ request()->search }}&user_id={{ request()->user_id }}">
                                                <i class="ml-1 text-sm cursor-pointer fa-solid fa-sort"></i>
                                            </a>
                                        @endif
                                    </th>
                                    <th class="w-1 px-4 py-2 whitespace-nowrap">
                                        role
                                        @if ((empty(request()->sort) || request()->sort == 'role') && request()->order == 'DESC')
                                            <a href="{{ url()->current() }}?sort=role&order=ASC&search={{ request()->search }}&user_id={{ request()->user_id }}">
                                                <i class="ml-1 text-sm cursor-pointer fa-solid fa-arrow-up-wide-short"></i>
                                            </a>
                                        @elseif ((empty(request()->sort) || request()->sort == 'role') && request()->order == 'ASC')
                                            <a href="{{ url()->current() }}?sort=role&order=DESC&search={{ request()->search }}&user_id={{ request()->user_id }}">
                                                <i class="ml-1 text-sm cursor-pointer fa-solid fa-arrow-down-short-wide"></i>
                                            </a>
                                        @else
                                            <a href="{{ url()->current() }}?sort=role&order=ASC&search={{ request()->search }}&user_id={{ request()->user_id }}">
                                                <i class="ml-1 text-sm cursor-pointer fa-solid fa-sort"></i>
                                            </a>
                                        @endif
                                    </th>
                                    <th class="px-4 py-2 whitespace-nowrap">
                                        name
                                        @if ((empty(request()->sort) || request()->sort == 'name') && request()->order == 'DESC')
                                            <a href="{{ url()->current() }}?sort=name&order=ASC&search={{ request()->search }}&user_id={{ request()->user_id }}">
                                                <i class="ml-1 text-sm cursor-pointer fa-solid fa-arrow-up-wide-short"></i>
                                            </a>
                                        @elseif ((empty(request()->sort) || request()->sort == 'name') && request()->order == 'ASC')
                                            <a href="{{ url()->current() }}?sort=name&order=DESC&search={{ request()->search }}&user_id={{ request()->user_id }}">
                                                <i class="ml-1 text-sm cursor-pointer fa-solid fa-arrow-down-short-wide"></i>
                                            </a>
                                        @else
                                            <a href="{{ url()->current() }}?sort=name&order=ASC&search={{ request()->search }}&user_id={{ request()->user_id }}">
                                                <i class="ml-1 text-sm cursor-pointer fa-solid fa-sort"></i>
                                            </a>
                                        @endif
                                    </th>
                                    <th class="px-4 py-2 whitespace-nowrap">
                                        email
                                        @if ((empty(request()->sort) || request()->sort == 'email') && request()->order == 'DESC')
                                            <a href="{{ url()->current() }}?sort=email&order=ASC&search={{ request()->search }}&user_id={{ request()->user_id }}">
                                                <i class="ml-1 text-sm cursor-pointer fa-solid fa-arrow-up-wide-short"></i>
                                            </a>
                                        @elseif ((empty(request()->sort) || request()->sort == 'email') && request()->order == 'ASC')
                                            <a href="{{ url()->current() }}?sort=email&order=DESC&search={{ request()->search }}&user_id={{ request()->user_id }}">
                                                <i class="ml-1 text-sm cursor-pointer fa-solid fa-arrow-down-short-wide"></i>
                                            </a>
                                        @else
                                            <a href="{{ url()->current() }}?sort=email&order=ASC&search={{ request()->search }}&user_id={{ request()->user_id }}">
                                                <i class="ml-1 text-sm cursor-pointer fa-solid fa-sort"></i>
                                            </a>
                                        @endif
                                    </th>
                                    <th class="px-4 py-2 whitespace-nowrap">
                                        email_verified_at
                                        @if ((empty(request()->sort) || request()->sort == 'email_verified_at') && request()->order == 'DESC')
                                            <a href="{{ url()->current() }}?sort=email_verified_at&order=ASC&search={{ request()->search }}&user_id={{ request()->user_id }}">
                                                <i class="ml-1 text-sm cursor-pointer fa-solid fa-arrow-up-wide-short"></i>
                                            </a>
                                        @elseif ((empty(request()->sort) || request()->sort == 'email_verified_at') && request()->order == 'ASC')
                                            <a href="{{ url()->current() }}?sort=email_verified_at&order=DESC&search={{ request()->search }}&user_id={{ request()->user_id }}">
                                                <i class="ml-1 text-sm cursor-pointer fa-solid fa-arrow-down-short-wide"></i>
                                            </a>
                                        @else
                                            <a href="{{ url()->current() }}?sort=email_verified_at&order=ASC&search={{ request()->search }}&user_id={{ request()->user_id }}">
                                                <i class="ml-1 text-sm cursor-pointer fa-solid fa-sort"></i>
                                            </a>
                                        @endif
                                    </th>
                                    <th class="px-4 py-2 whitespace-nowrap">
                                        actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr class="text-left bg-zinc-100 even:bg-gray-300 ">
                                        <td class="px-4 py-2 text-center">{{ $user->id }}</td>
                                        <td class="px-4 py-2 text-lg text-center">
                                            @switch($user->role->name)
                                                @case('user')
                                                    <i class="fa-solid fa-user" title="{{ $user->role->name }}"></i>
                                                @break

                                                @case('moderator')
                                                    <i class="fa-solid fa-user-secret" title="{{ $user->role->name }}"></i>
                                                @break

                                                @case('admin')
                                                    <i class="ml-1.5 fa-solid fa-user-gear" title="{{ $user->role->name }}"></i>
                                                @break

                                                @case('owner')
                                                    <i class="fa-solid fa-user-tie" title="{{ $user->role->name }}"></i>
                                                @break
                                            @endswitch
                                        </td>
                                        <td class="px-4 py-2">{{ $user->name }}</td>
                                        <td class="px-4 py-2">{{ $user->email }}</td>
                                        <td class="px-4 py-2">{{ $user->email_verified_at }}</td>
                                        <td class="px-4 py-2 whitespace-nowrap">
                                            <a href="{{ url()->current() }}?sort={{ request()->sort }}&order={{ request()->order }}&search={{ request()->search }}&user_id={{ $user->id }}&check_user_surveys_page={{ $check_user_surveys->currentPage() }}&users_page={{ $users->currentPage() }}" class="px-1.5 py-0.5 font-bold text-white bg-blue-700 rounded-md hover:bg-blue-800 whitespace-nowrap">
                                                <i class="fa-regular fa-eye"></i>
                                                Check user
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="w-full mt-3">{{ $users->appends(['sort' => request()->sort, 'order' => request()->order, 'search' => request()->search, 'user_id' => $user->id, 'check_user_surveys_page' => $check_user_surveys->currentPage()])->onEachSide(1)->links() }}</div>
                </div>

                <div class="mt-10" id="user-details">
                    <div class="flex flex-wrap items-center justify-between mb-2">
                        <h3 class="text-2xl font-bold">User deatails</h3>
                    </div>

                    <div class="w-full p-4 mx-auto text-lg rounded-md bg-slate-100">
                        <div class="flex flex-row items-start justify-start w-full gap-5">
                            <div class="grow">
                                <div class="">
                                    <span class="font-bold">ID:</span> {{ empty($check_user->id) ? 'n/a' : $check_user->id }}
                                </div>
                                <div class="">
                                    <span class="font-bold">Username:</span> {{ empty($check_user->name) ? 'n/a' : $check_user->name }}
                                </div>
                                <div class="">
                                    <span class="font-bold ">Email:</span>
                                    {{ empty($check_user->email) ? 'n/a' : $check_user->email }}
                                    ({{ empty($check_user->email_verified_at) ? 'not verified' : $check_user->email_verified_at }})
                                </div>
                                <div class="">
                                    <span class="font-bold ">Role:</span> {{ empty($check_user->role->name) ? 'n/a' : $check_user->role->name }}
                                </div>
                                <div class="">
                                    <span class="font-bold ">Created at:</span> {{ empty($check_user->created_at) ? 'n/a' : $check_user->created_at }}
                                </div>
                                <div class="">
                                    <span class="font-bold ">Banned:</span> {{ $check_user->bans()->count() }} times
                                </div>
                                <div class="">
                                    <span class="font-bold ">Created surveys:</span> {{ $check_user->surveys->count() }}
                                </div>
                                <div class="">
                                    <span class="font-bold ">Surveys taken:</span> {{ $surveys_taken }}
                                </div>
                            </div>

                            <div class="flex flex-col items-start justify-start gap-2 w-max-fit">
                                <button class="w-full px-3 py-1 font-bold text-white bg-blue-700 rounded-md hover:bg-blue-800 whitespace-nowrap">
                                    <i class="fa-solid fa-address-card"></i>
                                    Go to profile
                                </button>
                                <button class="w-full px-3 py-1 font-bold text-white rounded-md bg-amber-500 hover:bg-amber-600 whitespace-nowrap">
                                    <i class="fa-solid fa-arrow-rotate-right"></i>
                                    Reset password
                                </button>
                                <button class="w-full px-3 py-1 font-bold text-white rounded-md bg-amber-500 hover:bg-amber-600 whitespace-nowrap">
                                    <i class="fa-solid fa-ban"></i>
                                    Ban user
                                </button>
                                <button class="w-full px-3 py-1 font-bold text-white bg-red-700 rounded-md hover:bg-red-800 whitespace-nowrap">
                                    <i class="fa-solid fa-trash-can"></i>
                                    Delete user
                                </button>
                            </div>
                        </div>

                        <div class="flex flex-col items-start justify-start w-full gap-2 mt-5">
                            <div class="font-bold">User surveys:</div>

                            @foreach ($check_user_surveys as $survey)
                                <div class="flex flex-row items-center justify-between w-full gap-5 p-2 border border-gray-600 rounded-md">
                                    <a href="/survey/{{ $survey->id }}" class="overflow-hidden font-bold hover:underline whitespace-nowrap text-ellipsis">{{ $survey->title }}</a>
                                    <button class="px-3 py-1 font-bold text-white bg-blue-700 rounded-md hover:bg-blue-800 whitespace-nowrap">
                                        <i class="fa-regular fa-eye"></i>
                                        Check survey
                                    </button>
                                </div>
                            @endforeach

                            <div class="w-full mt-3">{{ $check_user_surveys->appends(['sort' => request()->sort, 'order' => request()->order, 'search' => request()->search, 'user_id' => $user->id, 'users_page' => $users->currentPage()])->onEachSide(1)->links() }}</div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
