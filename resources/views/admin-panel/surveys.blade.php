@php $notifications = ['reports' => $reports_count, 'contact' => $contact_count]; @endphp

@extends('layouts.layout')

@section('title', 'Admin panel - surveys')

@section('content')
    <section class="w-full">
        <div class="relative flex flex-col items-start max-w-screen-xl mx-auto md:flex-row">
            <div class="sticky top-0 z-10 w-60 md:w-1/3 lg:w-1/4">
                <x-admin-nav active_page="surveys" :notifications="$notifications" />
            </div>

            <div class="flex flex-col w-full p-5 md:w-2/3 lg:w-3/4 min-h-screen">
                <h2 class="mt-10 text-3xl font-bold text-center md:mt-0">Surveys Management</h2>

                <div class="mt-10">
                    <div class="flex flex-wrap items-center justify-between mb-2">
                        <h3 class="text-2xl font-bold">Surveys table</h3>
                    </div>

                    <div class="flex flex-wrap items-center justify-between gap-2 mb-2">
                        <form action="/admin-panel/surveys" method="GET" class="relative flex flex-row grow">
                            <input name="search" type="text" value="{{ request()->search }}" placeholder="Search by name..." class="px-3 py-1.5 grow border rounded-md border-gray-600 text-black">
                            <input name="sort" type="text" value="{{ request()->sort }}" hidden>
                            <input name="order" type="text" value="{{ request()->order }}" hidden>
                            <button type="submit" class="absolute  h-full right-0 px-3 py-1.5 rounded-tr-md rounded-br-md bg-blue-700 border-gray-600 hover:bg-blue-800 text-white font-bold">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                        </form>
                        <button class="px-3 py-1.5 rounded-md bg-green-700 hover:bg-green-800 text-white font-bold">
                            <i class="fa-solid fa-file-circle-plus"></i>
                            Create new survey
                        </button>
                    </div>

                    <div class="w-full overflow-x-auto scroll-visible">
                        <table class="w-full mx-auto overflow-hidden rounded-md">
                            <thead>
                                <tr class="text-left text-white divide-x bg-slate-800">
                                    <th class="w-1 px-4 py-2 whitespace-nowrap">
                                        id
                                        @if ((empty(request()->sort) || request()->sort == 'id') && request()->order == 'DESC')
                                            <a href="{{ url()->current() }}?sort=id&order=ASC&search={{ request()->search }}">
                                                <i class="ml-1 text-sm cursor-pointer fa-solid fa-arrow-up-wide-short"></i>
                                            </a>
                                        @elseif ((empty(request()->sort) || request()->sort == 'id') && request()->order == 'ASC')
                                            <a href="{{ url()->current() }}?sort=id&order=DESC&search={{ request()->search }}">
                                                <i class="ml-1 text-sm cursor-pointer fa-solid fa-arrow-down-short-wide"></i>
                                            </a>
                                        @else
                                            <a href="{{ url()->current() }}?sort=id&order=ASC&search={{ request()->search }}">
                                                <i class="ml-1 text-sm cursor-pointer fa-solid fa-sort"></i>
                                            </a>
                                        @endif
                                    </th>
                                    <th class="px-4 py-2 whitespace-nowrap">
                                        title
                                        @if ((empty(request()->sort) || request()->sort == 'title') && request()->order == 'DESC')
                                            <a href="{{ url()->current() }}?sort=title&order=ASC&search={{ request()->search }}">
                                                <i class="ml-1 text-sm cursor-pointer fa-solid fa-arrow-up-wide-short"></i>
                                            </a>
                                        @elseif ((empty(request()->sort) || request()->sort == 'title') && request()->order == 'ASC')
                                            <a href="{{ url()->current() }}?sort=title&order=DESC&search={{ request()->search }}">
                                                <i class="ml-1 text-sm cursor-pointer fa-solid fa-arrow-down-short-wide"></i>
                                            </a>
                                        @else
                                            <a href="{{ url()->current() }}?sort=title&order=ASC&search={{ request()->search }}">
                                                <i class="ml-1 text-sm cursor-pointer fa-solid fa-sort"></i>
                                            </a>
                                        @endif
                                    </th>
                                    <th class="px-4 py-2 whitespace-nowrap">
                                        owner
                                        @if ((empty(request()->sort) || request()->sort == 'owner') && request()->order == 'DESC')
                                            <a href="{{ url()->current() }}?sort=owner&order=ASC&search={{ request()->search }}">
                                                <i class="ml-1 text-sm cursor-pointer fa-solid fa-arrow-up-wide-short"></i>
                                            </a>
                                        @elseif ((empty(request()->sort) || request()->sort == 'owner') && request()->order == 'ASC')
                                            <a href="{{ url()->current() }}?sort=owner&order=DESC&search={{ request()->search }}">
                                                <i class="ml-1 text-sm cursor-pointer fa-solid fa-arrow-down-short-wide"></i>
                                            </a>
                                        @else
                                            <a href="{{ url()->current() }}?sort=owner&order=ASC&search={{ request()->search }}">
                                                <i class="ml-1 text-sm cursor-pointer fa-solid fa-sort"></i>
                                            </a>
                                        @endif
                                    </th>
                                    <th class="px-4 py-2 whitespace-nowrap">
                                        start_date
                                        @if ((empty(request()->sort) || request()->sort == 'start_date') && request()->order == 'DESC')
                                            <a href="{{ url()->current() }}?sort=start_date&order=ASC&search={{ request()->search }}">
                                                <i class="ml-1 text-sm cursor-pointer fa-solid fa-arrow-up-wide-short"></i>
                                            </a>
                                        @elseif ((empty(request()->sort) || request()->sort == 'start_date') && request()->order == 'ASC')
                                            <a href="{{ url()->current() }}?sort=start_date&order=DESC&search={{ request()->search }}">
                                                <i class="ml-1 text-sm cursor-pointer fa-solid fa-arrow-down-short-wide"></i>
                                            </a>
                                        @else
                                            <a href="{{ url()->current() }}?sort=start_date&order=ASC&search={{ request()->search }}">
                                                <i class="ml-1 text-sm cursor-pointer fa-solid fa-sort"></i>
                                            </a>
                                        @endif
                                    </th>
                                    <th class="px-4 py-2 whitespace-nowrap">
                                        end_date
                                        @if ((empty(request()->sort) || request()->sort == 'end_date') && request()->order == 'DESC')
                                            <a href="{{ url()->current() }}?sort=end_date&order=ASC&search={{ request()->search }}">
                                                <i class="ml-1 text-sm cursor-pointer fa-solid fa-arrow-up-wide-short"></i>
                                            </a>
                                        @elseif ((empty(request()->sort) || request()->sort == 'end_date') && request()->order == 'ASC')
                                            <a href="{{ url()->current() }}?sort=end_date&order=DESC&search={{ request()->search }}">
                                                <i class="ml-1 text-sm cursor-pointer fa-solid fa-arrow-down-short-wide"></i>
                                            </a>
                                        @else
                                            <a href="{{ url()->current() }}?sort=end_date&order=ASC&search={{ request()->search }}">
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
                                @foreach ($surveys as $survey)
                                    <tr class="text-left bg-zinc-100 even:bg-gray-300 ">
                                        <td class="px-4 py-2 text-center">{{ $survey->id }}</td>
                                        <td class="px-4 py-2">
                                            <div class="w-[40rem]">{{ $survey->title }}</div>
                                        </td>
                                        <td class="px-4 py-2 whitespace-nowrap">{{ $survey->owner->name }}</td>
                                        <td class="px-4 py-2 whitespace-nowrap">{{ empty($survey->start_date) ? 'NULL' : $survey->start_date }}</td>
                                        <td class="px-4 py-2 whitespace-nowrap">{{ empty($survey->end_date) ? 'NULL' : $survey->end_date }}</td>
                                        <td class="px-4 py-2 whitespace-nowrap">
                                            <a href="{{ url()->current() }}?sort={{ request()->sort }}&order={{ request()->order }}&search={{ request()->search }}&survey_id={{ $survey->id }}&check_survey_questions_page={{ $check_survey_questions->currentPage() }}&surveys_page={{ $surveys->currentPage() }}" class="px-1.5 py-0.5 font-bold text-white bg-blue-700 rounded-md hover:bg-blue-800 whitespace-nowrap">
                                                <i class="fa-regular fa-eye"></i>
                                                Check survey
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>

                    <div class="w-full mt-3">{{ $surveys->appends(['check_survey_questions_page' => $check_survey_questions->currentPage()])->onEachSide(1)->links() }}</div>
                </div>

                <div class="mt-10" id="survey-details">
                    <div class="flex flex-wrap items-center justify-between mb-2">
                        <h3 class="text-2xl font-bold">Survey deatails</h3>
                    </div>

                    <div class="w-full p-4 mx-auto text-lg rounded-md bg-slate-100">
                        <div class="flex flex-row items-start justify-start w-full gap-5">
                            <div class="grow">
                                <div class="">
                                    <span class="font-bold">ID:</span> {{ empty($check_survey->id) ? 'n/a' : $check_survey->id }}
                                </div>
                                <div class="">
                                    <span class="font-bold">Start date:</span> {{ empty($check_survey->start_date) ? 'n/a' : $check_survey->start_date }}
                                </div>
                                <div class="">
                                    <span class="font-bold ">End date:</span> {{ empty($check_survey->end_date) ? 'n/a' : $check_survey->end_date }}
                                </div>
                                <div class="mb-3">
                                    <span class="font-bold">Allow not logged:</span> {{ empty($check_survey->allow_not_logged) ? 'n/a' : ($check_survey->allow_not_logged ? 'Yes' : 'No') }}
                                </div>
                                <div class="mb-1">
                                    <span class="font-bold">Title:<br></span> {{ empty($check_survey->title) ? 'n/a' : $check_survey->title }}
                                </div>
                                <div class="mb-1">
                                    <span class="font-bold">Description:<br></span> {{ empty($check_survey->description) ? 'n/a' : $check_survey->description }}
                                </div>
                                <div class="mb-1">
                                    <span class="font-bold">End message:<br></span> {{ empty($check_survey->end_message) ? 'n/a' : $check_survey->end_message }}
                                </div>
                            </div>

                            <div class="flex flex-col items-start justify-start gap-2 w-max-fit">
                                <button class="w-full px-3 py-1 font-bold text-white bg-blue-700 rounded-md hover:bg-blue-800 whitespace-nowrap">
                                    <i class="fa-regular fa-rectangle-list"></i>
                                    Go to survey
                                </button>
                                <button class="w-full px-3 py-1 font-bold text-white rounded-md bg-amber-500 hover:bg-amber-600 whitespace-nowrap">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                    Edit survey
                                </button>
                                <button class="w-full px-3 py-1 font-bold text-white rounded-md bg-amber-500 hover:bg-amber-600 whitespace-nowrap">
                                    <i class="fa-solid fa-ban"></i>
                                    Block survey
                                </button>
                                <form action="/admin-panel/surveys/{{ $check_survey->id }}" method="POST" class="relative flex flex-row grow">
                                    @method('delete')
                                    @csrf

                                    <button type="submit" class="w-full px-3 py-1 font-bold text-white bg-red-700 rounded-md hover:bg-red-800 whitespace-nowrap">
                                        <i class="fa-solid fa-trash-can"></i>
                                        Delete survey
                                    </button>
                                </form>
                            </div>
                        </div>

                        <div class="flex flex-col items-start justify-start w-full gap-2 mt-5">
                            <div class="font-bold">Survey questions:</div>

                            @foreach ($check_survey_questions as $question)
                                <div class="flex flex-col items-start justify-start w-full gap-5 p-2 border border-gray-600 rounded-md grow">
                                    <div class="grow">
                                        <div class="mb-1">
                                            <span class="font-bold">Question:</span> {{ $question->question }}
                                        </div>
                                        <div class="mb-1">
                                            <span class="font-bold">Description:</span> {{ $question->description }}
                                        </div>
                                        <div class="mb-5">
                                            <span class="font-bold">Type:</span> {{ $question->type->name }}
                                        </div>
                                        <div class="">
                                            <span class="font-bold">Answers:</span>
                                            @foreach ($question->answers as $answer)
                                                <div class="ml-5 list-item">{{ $answer->text }}</div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <button class="px-3 py-1 font-bold text-white bg-blue-700 rounded-md hover:bg-blue-800 whitespace-nowrap">
                                        <i class="fa-regular fa-eye"></i>
                                        Check question
                                    </button>
                                </div>
                            @endforeach

                            <div class="w-full mt-3">{{ $check_survey_questions->appends(['surveys_page' => $surveys->currentPage()])->onEachSide(1)->links() }}</div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
