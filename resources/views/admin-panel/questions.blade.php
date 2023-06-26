@php $notifications = ['reports' => $reports_count, 'contact' => $contact_count]; @endphp

@extends('layouts.layout')

@section('title', 'Admin panel - questions')

@section('content')
    <section class="w-full">
        <div class="relative flex flex-col items-start max-w-screen-xl mx-auto md:flex-row">
            <div class="sticky top-0 z-10 w-60 md:w-1/3 lg:w-1/4">
                <x-admin-nav active_page="questions" :notifications="$notifications" />
            </div>
            <div class="flex flex-col w-full p-5 md:w-2/3 lg:w-3/4 min-h">
                <h2 class="mt-10 mb-10 text-3xl font-bold text-center md:mt-0">Questions Management</h2>

                <div class="">
                    <div class="flex flex-wrap items-center justify-between mb-2">
                        <h3 class="text-2xl font-bold">Questions table</h3>
                        <button class="px-3 py-1.5 rounded-md bg-green-700 hover:bg-green-800 text-white font-bold">
                            <i class="mr-1 fa-solid fa-plus"></i>
                            Create new admin
                        </button>
                    </div>

                    <div class="w-full overflow-x-auto">
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
                                        question
                                        @if ((empty(request()->sort) || request()->sort == 'question') && request()->order == 'DESC')
                                            <a href="{{ url()->current() }}?sort=question&order=ASC&search={{ request()->search }}&user_id={{ request()->user_id }}">
                                                <i class="ml-1 text-sm cursor-pointer fa-solid fa-arrow-up-wide-short"></i>
                                            </a>
                                        @elseif ((empty(request()->sort) || request()->sort == 'question') && request()->order == 'ASC')
                                            <a href="{{ url()->current() }}?sort=question&order=DESC&search={{ request()->search }}&user_id={{ request()->user_id }}">
                                                <i class="ml-1 text-sm cursor-pointer fa-solid fa-arrow-down-short-wide"></i>
                                            </a>
                                        @else
                                            <a href="{{ url()->current() }}?sort=question&order=ASC&search={{ request()->search }}&user_id={{ request()->user_id }}">
                                                <i class="ml-1 text-sm cursor-pointer fa-solid fa-sort"></i>
                                            </a>
                                        @endif
                                    </th>
                                    <th class="px-4 py-2 whitespace-nowrap">
                                        description
                                        @if ((empty(request()->sort) || request()->sort == 'description') && request()->order == 'DESC')
                                            <a href="{{ url()->current() }}?sort=description&order=ASC&search={{ request()->search }}&user_id={{ request()->user_id }}">
                                                <i class="ml-1 text-sm cursor-pointer fa-solid fa-arrow-up-wide-short"></i>
                                            </a>
                                        @elseif ((empty(request()->sort) || request()->sort == 'description') && request()->order == 'ASC')
                                            <a href="{{ url()->current() }}?sort=description&order=DESC&search={{ request()->search }}&user_id={{ request()->user_id }}">
                                                <i class="ml-1 text-sm cursor-pointer fa-solid fa-arrow-down-short-wide"></i>
                                            </a>
                                        @else
                                            <a href="{{ url()->current() }}?sort=description&order=ASC&search={{ request()->search }}&user_id={{ request()->user_id }}">
                                                <i class="ml-1 text-sm cursor-pointer fa-solid fa-sort"></i>
                                            </a>
                                        @endif
                                    </th>
                                    <th class="px-4 py-2 whitespace-nowrap">
                                        type
                                        @if ((empty(request()->sort) || request()->sort == 'type') && request()->order == 'DESC')
                                            <a href="{{ url()->current() }}?sort=type&order=ASC&search={{ request()->search }}&user_id={{ request()->user_id }}">
                                                <i class="ml-1 text-sm cursor-pointer fa-solid fa-arrow-up-wide-short"></i>
                                            </a>
                                        @elseif ((empty(request()->sort) || request()->sort == 'type') && request()->order == 'ASC')
                                            <a href="{{ url()->current() }}?sort=type&order=DESC&search={{ request()->search }}&user_id={{ request()->user_id }}">
                                                <i class="ml-1 text-sm cursor-pointer fa-solid fa-arrow-down-short-wide"></i>
                                            </a>
                                        @else
                                            <a href="{{ url()->current() }}?sort=type&order=ASC&search={{ request()->search }}&user_id={{ request()->user_id }}">
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
                                @foreach ($questions as $question)
                                    <tr class="text-left bg-zinc-100 even:bg-gray-300 ">
                                        <td class="px-4 py-2 text-center">{{ $question->id }}</td>
                                        <td class="px-4 py-2">{{ $question->question }}</td>
                                        <td class="px-4 py-2">{{ $question->description }}</td>
                                        <td class="px-4 py-2">{{ $question->type->name }}</td>
                                        <td class="px-4 py-2 whitespace-nowrap">
                                            <a href="{{ url()->current() }}?sort={{ request()->sort }}&order={{ request()->order }}&search={{ request()->search }}&questions_page={{ $questions->currentPage() }}" class="px-1.5 py-0.5 font-bold text-white bg-blue-700 rounded-md hover:bg-blue-800 whitespace-nowrap">
                                                <i class="fa-regular fa-eye"></i>
                                                Check user
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
