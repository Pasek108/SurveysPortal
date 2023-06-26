@php $notifications = ['reports' => $reports_count, 'contact' => $contact_count]; @endphp

@extends('layouts.layout')

@section('title', 'Admin panel - reports')

@section('content')
    <section class="w-full">
        <div class="relative flex flex-col items-start max-w-screen-xl mx-auto md:flex-row">
            <div class="sticky top-0 z-10 w-60 md:w-1/3 lg:w-1/4">
                <x-admin-nav active_page="reports" :notifications="$notifications" />
            </div>

            <div class="flex flex-col w-full p-5 md:w-2/3 lg:w-3/4 min-h">
                <h2 class="mt-10 text-3xl font-bold text-center md:mt-0">Reports</h2>

                <div class="mt-10">
                    <div class="w-full p-4 mx-auto text-lg rounded-md bg-slate-100">
                        <div class="flex flex-wrap items-center justify-between mb-2">
                            <h3 class="text-2xl font-bold">Users table</h3>
                        </div>

                        <div class="flex flex-col items-start justify-start w-full gap-3">
                            @foreach ($reports as $report)
                                <div class="flex flex-col items-start justify-start w-full gap-5 p-3 border rounded-md border-black {{ $report->read ? '' : 'bg-red-50' }}">
                                    <div class="grow">
                                        <div class="font-bold">{{ $report->created_at }}</div>
                                        <div class="font-bold">
                                            <a href="/admin-panel/users?user_id={{ $report->user->id }}" class="text-blue-700 hover:underline">{{ $report->user->name }}</a>
                                            reported
                                            <a href="/admin-panel/surveys?survey_id={{ $report->survey->id }}" class="text-blue-700 hover:underline">survey {{ $report->survey->id }}</a>
                                        </div>
                                        <div class="">{{ $report->reason }}</div>
                                    </div>

                                    <div class="flex flex-row items-start justify-start gap-2 w-max-fit">
                                        @if (!$report->read)
                                            <form method="POST" action="/admin-panel/reports/mark-as-read/{{ $report->id }}">
                                                @csrf
                                                <button type="submit" class="w-full px-3 py-1 font-bold text-white bg-green-700 rounded-md hover:bg-green-800 whitespace-nowrap">
                                                    <i class="fa-regular fa-circle-check"></i>
                                                    Mark as done
                                                </button>
                                            </form>
                                        @endif

                                        <form method="POST" action="/admin-panel/reports/delete/{{ $report->id }}">
                                            @csrf
                                            <button type="submit" class="w-full px-3 py-1 font-bold text-white bg-red-700 rounded-md hover:bg-red-800 whitespace-nowrap">
                                                <i class="fa-solid fa-trash-can"></i>
                                                Delete report
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach


                        </div>

                        <div class="w-full mt-3">{{ $reports->onEachSide(1)->links() }}</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
