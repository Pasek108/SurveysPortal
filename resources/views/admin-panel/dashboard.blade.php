@php $notifications = ['reports' => $reports_count, 'contact' => $contact_count]; @endphp

@extends('layouts.layout')

@section('title', 'Admin panel - dashboard')

@section('content')

    <section class="w-full">
        <div class="relative flex flex-col items-start max-w-screen-xl mx-auto md:flex-row">
            <div class="sticky top-0 z-10 w-60 md:w-1/3 lg:w-1/4">
                <x-admin-nav active_page="dashboard" :notifications="$notifications" />
            </div>

            <div class="flex flex-col w-full p-5 md:w-2/3 lg:w-3/4 min-h-screen">
                <h2 class="mt-10 text-3xl font-bold text-center md:mt-0">Welcome {{ auth()->user()->name }}!</h2>

                <div class="mt-10">
                    <div class="w-full p-4 mx-auto text-lg rounded-md bg-slate-100">
                        Database have:
                        <div>{{ $users_count }} users</div>
                        <div>{{ $surveys_count }} surveys</div>
                        <div>{{ $questions_count }} questions</div>
                        <div>{{ $answers_count }} answers</div>
                        <div>{{ $tags_count }} tags</div>
                        <div>{{ $bans_count }} bans</div>
                        <div>{{ $ratings_count }} ratings</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
