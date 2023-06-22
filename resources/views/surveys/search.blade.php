@extends('layouts.layout')

@section('title', 'Search')

@section('content')

    <x-section>
        <div class="flex flex-col w-full max-w-screen-xl mx-auto md:w-full">
            <form class="flex flex-col items-center justify-center">
                <input class="px-3 py-1.5 w-full border rounded-md border-gray-600 text-black" type="text" placeholder="Search a phrase...">
                <div class="sort">Sort by date/rating/respondents/popularity</div>
                <div>Search by tags</div>
                <button>Search</button>
            </form>

            <div class="flex flex-row flex-wrap w-full gap-5 px-4 mt-5 mb-9 md:w-full md:px-0">
                @foreach ($surveys as $survey)
                    <x-survey-card :survey="$survey" />
                @endforeach
            </div>
        </div>
    </x-section>

@endsection
