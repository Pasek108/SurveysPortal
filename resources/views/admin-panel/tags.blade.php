@php $notifications = ['reports' => $reports_count, 'contact' => $contact_count]; @endphp

@extends('layouts.layout')

@section('title', 'Admin panel - tags')

@section('content')
    <section class="w-full">
        <div class="relative flex flex-col items-start max-w-screen-xl mx-auto md:flex-row">
            <div class="sticky top-0 z-10 w-60 md:w-1/3 lg:w-1/4">
                <x-admin-nav active_page="tags" :notifications="$notifications" />
            </div>

            <div class="flex flex-col w-full p-5 md:w-2/3 lg:w-3/4 min-h-screen">
                <h2 class="mt-10 text-3xl font-bold text-center md:mt-0">Tags Management</h2>

                <div class="mt-10">
                    <div class="flex flex-wrap items-center justify-between mb-2">
                        <h3 class="text-2xl font-bold">Tags table</h3>
                    </div>

                    <div class="flex flex-wrap items-center justify-between gap-2 mb-2">
                        <form action="/admin-panel/tags" method="GET" class="relative flex flex-row grow">
                            <input name="search" type="text" value="{{ request()->search }}" placeholder="Search by name..." class="px-3 py-1.5 grow border rounded-md border-gray-600 text-black">
                            <input name="sort" type="text" value="{{ request()->sort }}" hidden>
                            <input name="order" type="text" value="{{ request()->order }}" hidden>
                            <button type="submit" class="absolute  h-full right-0 px-3 py-1.5 rounded-tr-md rounded-br-md bg-blue-700 border-gray-600 hover:bg-blue-800 text-white font-bold">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                        </form>
                        <button class="px-3 py-1.5 rounded-md bg-green-700 hover:bg-green-800 text-white font-bold">
                            <i class="fa-solid fa-tag"></i>
                            Create new tag
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
                                    <th class="px-4 py-2 whitespace-nowrap">
                                        name
                                        @if ((empty(request()->sort) || request()->sort == 'name') && request()->order == 'DESC')
                                            <a href="{{ url()->current() }}?sort=name&order=ASC&search={{ request()->search }}&name_id={{ request()->user_id }}">
                                                <i class="ml-1 text-sm cursor-pointer fa-solid fa-arrow-up-wide-short"></i>
                                            </a>
                                        @elseif ((empty(request()->sort) || request()->sort == 'name') && request()->order == 'ASC')
                                            <a href="{{ url()->current() }}?sort=name&order=DESC&search={{ request()->search }}&name_id={{ request()->user_id }}">
                                                <i class="ml-1 text-sm cursor-pointer fa-solid fa-arrow-down-short-wide"></i>
                                            </a>
                                        @else
                                            <a href="{{ url()->current() }}?sort=name&order=ASC&search={{ request()->search }}&name_id={{ request()->user_id }}">
                                                <i class="ml-1 text-sm cursor-pointer fa-solid fa-sort"></i>
                                            </a>
                                        @endif
                                    </th>
                                    <th class="w-1 px-4 py-2 whitespace-nowrap">
                                        actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tags as $tag)
                                    <tr class="text-left bg-zinc-100 even:bg-gray-300 ">
                                        <td class="px-4 py-2 text-center">{{ $tag->id }}</td>
                                        <td class="px-4 py-2">{{ $tag->name }}</td>

                                        <td class="px-4 py-2 whitespace-nowrap">
                                            <a href="{{ url()->current() }}?sort={{ request()->sort }}&order={{ request()->order }}&search={{ request()->search }}&bans_page={{ $tags->currentPage() }}" class="px-1.5 py-0.5 font-bold text-white bg-blue-700 rounded-md hover:bg-blue-800 whitespace-nowrap">
                                                <i class="fa-regular fa-eye"></i>
                                                Show surveys
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="w-full mt-3">{{ $tags->appends(['sort' => request()->sort, 'order' => request()->order, 'search' => request()->search])->onEachSide(1)->links() }}</div>
                </div>
            </div>
        </div>
    </section>

@endsection
