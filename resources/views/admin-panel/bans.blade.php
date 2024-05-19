@php $notifications = ['reports' => $reports_count, 'contact' => $contact_count]; @endphp

@extends('layouts.layout')

@section('title', 'Admin panel - bans')

@section('content')
    <section class="w-full">
        <div class="relative flex flex-col items-start max-w-screen-xl mx-auto md:flex-row">
            <div class="sticky top-0 z-10 w-60 md:w-1/3 lg:w-1/4">
                <x-admin-nav active_page="bans" :notifications="$notifications" />
            </div>

            <div class="flex flex-col w-full p-5 md:w-2/3 lg:w-3/4 min-h-screen">
                <h2 class="mt-10 text-3xl font-bold text-center md:mt-0">Bans Management</h2>

                <div class="mt-10">
                    <div class="flex flex-wrap items-center justify-between mb-2">
                        <h3 class="text-2xl font-bold">Bans table</h3>
                    </div>

                    <div class="flex flex-wrap items-center justify-between gap-2 mb-2">
                        <form action="/admin-panel/bans" method="GET" class="relative flex flex-row grow">
                            <input name="search_user" type="text" value="{{ request()->search_user }}" placeholder="Search by user name..." class="px-3 py-1.5 grow border rounded-md border-gray-600 text-black">
                            <input name="sort" type="text" value="{{ request()->sort }}" hidden>
                            <input name="order" type="text" value="{{ request()->order }}" hidden>
                            <input name="search_reason" type="text" value="{{ request()->search_reason }}" hidden>
                            <button type="submit" class="absolute  h-full right-0 px-3 py-1.5 rounded-tr-md rounded-br-md bg-blue-700 border-gray-600 hover:bg-blue-800 text-white font-bold">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                        </form>
                        <form action="/admin-panel/bans" method="GET" class="relative flex flex-row grow">
                            <input name="search_reason" type="text" value="{{ request()->search_reason }}" placeholder="Search by reason..." class="px-3 py-1.5 grow border rounded-md border-gray-600 text-black">
                            <input name="sort" type="text" value="{{ request()->sort }}" hidden>
                            <input name="order" type="text" value="{{ request()->order }}" hidden>
                            <input name="search_user" type="text" value="{{ request()->search_user }}" hidden>
                            <button type="submit" class="absolute  h-full right-0 px-3 py-1.5 rounded-tr-md rounded-br-md bg-blue-700 border-gray-600 hover:bg-blue-800 text-white font-bold">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                        </form>
                    </div>

                    <div class="w-full overflow-x-auto scroll-visible">
                        <table class="w-full mx-auto overflow-hidden rounded-md">
                            <thead>
                                <tr class="text-left text-white divide-x bg-slate-800">
                                    <th class="w-1 px-4 py-2 whitespace-nowrap">
                                        id
                                        @if ((empty(request()->sort) || request()->sort == 'id') && request()->order == 'DESC')
                                            <a href="{{ url()->current() }}?sort=id&order=ASC&search_user={{ request()->search_user }}&search_reason={{ request()->search_reason }}&user_id={{ request()->user_id }}">
                                                <i class="ml-1 text-sm cursor-pointer fa-solid fa-arrow-up-wide-short"></i>
                                            </a>
                                        @elseif ((empty(request()->sort) || request()->sort == 'id') && request()->order == 'ASC')
                                            <a href="{{ url()->current() }}?sort=id&order=DESC&search_user={{ request()->search_user }}&search_reason={{ request()->search_reason }}&user_id={{ request()->user_id }}">
                                                <i class="ml-1 text-sm cursor-pointer fa-solid fa-arrow-down-short-wide"></i>
                                            </a>
                                        @else
                                            <a href="{{ url()->current() }}?sort=id&order=ASC&search_user={{ request()->search_user }}&search_reason={{ request()->search_reason }}&user_id={{ request()->user_id }}">
                                                <i class="ml-1 text-sm cursor-pointer fa-solid fa-sort"></i>
                                            </a>
                                        @endif
                                    </th>
                                    <th class="w-1 px-4 py-2 whitespace-nowrap">
                                        user
                                        @if ((empty(request()->sort) || request()->sort == 'user') && request()->order == 'DESC')
                                            <a href="{{ url()->current() }}?sort=user&order=ASC&search_user={{ request()->search_user }}&search_reason={{ request()->search_reason }}&user_id={{ request()->user_id }}">
                                                <i class="ml-1 text-sm cursor-pointer fa-solid fa-arrow-up-wide-short"></i>
                                            </a>
                                        @elseif ((empty(request()->sort) || request()->sort == 'user') && request()->order == 'ASC')
                                            <a href="{{ url()->current() }}?sort=user&order=DESC&search_user={{ request()->search_user }}&search_reason={{ request()->search_reason }}&user_id={{ request()->user_id }}">
                                                <i class="ml-1 text-sm cursor-pointer fa-solid fa-arrow-down-short-wide"></i>
                                            </a>
                                        @else
                                            <a href="{{ url()->current() }}?sort=user&order=ASC&search_user={{ request()->search_user }}&search_reason={{ request()->search_reason }}&user_id={{ request()->user_id }}">
                                                <i class="ml-1 text-sm cursor-pointer fa-solid fa-sort"></i>
                                            </a>
                                        @endif
                                    </th>
                                    <th class="px-4 py-2 whitespace-nowrap">
                                        reason
                                        @if ((empty(request()->sort) || request()->sort == 'reason') && request()->order == 'DESC')
                                            <a href="{{ url()->current() }}?sort=reason&order=ASC&search_user={{ request()->search_user }}&search_reason={{ request()->search_reason }}&user_id={{ request()->user_id }}">
                                                <i class="ml-1 text-sm cursor-pointer fa-solid fa-arrow-up-wide-short"></i>
                                            </a>
                                        @elseif ((empty(request()->sort) || request()->sort == 'reason') && request()->order == 'ASC')
                                            <a href="{{ url()->current() }}?sort=reason&order=DESC&search_user={{ request()->search_user }}&search_reason={{ request()->search_reason }}&user_id={{ request()->user_id }}">
                                                <i class="ml-1 text-sm cursor-pointer fa-solid fa-arrow-down-short-wide"></i>
                                            </a>
                                        @else
                                            <a href="{{ url()->current() }}?sort=reason&order=ASC&search_user={{ request()->search_user }}&search_reason={{ request()->search_reason }}&user_id={{ request()->user_id }}">
                                                <i class="ml-1 text-sm cursor-pointer fa-solid fa-sort"></i>
                                            </a>
                                        @endif
                                    </th>
                                    <th class="px-4 py-2 whitespace-nowrap">
                                        end_date
                                        @if ((empty(request()->sort) || request()->sort == 'end_date') && request()->order == 'DESC')
                                            <a href="{{ url()->current() }}?sort=end_date&order=ASC&search_user={{ request()->search_user }}&search_reason={{ request()->search_reason }}&user_id={{ request()->user_id }}">
                                                <i class="ml-1 text-sm cursor-pointer fa-solid fa-arrow-up-wide-short"></i>
                                            </a>
                                        @elseif ((empty(request()->sort) || request()->sort == 'end_date') && request()->order == 'ASC')
                                            <a href="{{ url()->current() }}?sort=end_date&order=DESC&search_user={{ request()->search_user }}&search_reason={{ request()->search_reason }}&user_id={{ request()->user_id }}">
                                                <i class="ml-1 text-sm cursor-pointer fa-solid fa-arrow-down-short-wide"></i>
                                            </a>
                                        @else
                                            <a href="{{ url()->current() }}?sort=end_date&order=ASC&search_user={{ request()->search_user }}&search_reason={{ request()->search_reason }}&user_id={{ request()->user_id }}">
                                                <i class="ml-1 text-sm cursor-pointer fa-solid fa-sort"></i>
                                            </a>
                                        @endif
                                    </th>
                                    <th class="px-4 py-2 whitespace-nowrap">
                                        created_at
                                        @if ((empty(request()->sort) || request()->sort == 'created_at') && request()->order == 'DESC')
                                            <a href="{{ url()->current() }}?sort=created_at&order=ASC&search_user={{ request()->search_user }}&search_reason={{ request()->search_reason }}&user_id={{ request()->user_id }}">
                                                <i class="ml-1 text-sm cursor-pointer fa-solid fa-arrow-up-wide-short"></i>
                                            </a>
                                        @elseif ((empty(request()->sort) || request()->sort == 'created_at') && request()->order == 'ASC')
                                            <a href="{{ url()->current() }}?sort=created_at&order=DESC&search_user={{ request()->search_user }}&search_reason={{ request()->search_reason }}&user_id={{ request()->user_id }}">
                                                <i class="ml-1 text-sm cursor-pointer fa-solid fa-arrow-down-short-wide"></i>
                                            </a>
                                        @else
                                            <a href="{{ url()->current() }}?sort=created_at&order=ASC&search_user={{ request()->search_user }}&search_reason={{ request()->search_reason }}&user_id={{ request()->user_id }}">
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
                                @foreach ($bans as $ban)
                                    <tr class="text-left bg-zinc-100 even:bg-gray-300 ">
                                        <td class="px-4 py-2 text-center">{{ $ban->id }}</td>
                                        <td class="px-4 py-2 text-center">{{ $ban->user->name }}</td>
                                        <td class="px-4 py-2">{{ $ban->reason }}</td>
                                        <td class="px-4 py-2">{{ $ban->end_date }}</td>
                                        <td class="px-4 py-2">{{ $ban->created_at }}</td>
                                        <td class="px-4 py-2 whitespace-nowrap">
                                            <a href="{{ url()->current() }}?sort={{ request()->sort }}&order={{ request()->order }}&search_user={{ request()->search_user }}&search_reason={{ request()->search_reason }}&bans_page={{ $bans->currentPage() }}" class="px-1.5 py-0.5 font-bold text-white bg-blue-700 rounded-md hover:bg-blue-800 whitespace-nowrap">
                                                <i class="fa-solid fa-user-check"></i>
                                                Unban
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="w-full mt-3">{{ $bans->appends(['sort' => request()->sort, 'order' => request()->order, 'search_user' => request()->search_user, 'search_reason' => request()->search_reason])->onEachSide(1)->links() }}</div>
                </div>
            </div>
        </div>
    </section>

@endsection
