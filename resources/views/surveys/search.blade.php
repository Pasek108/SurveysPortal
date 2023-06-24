@extends('layouts.layout')

@section('title', 'Search')

@section('content')

    <x-section>
        <div class="flex flex-col w-full max-w-screen-xl mx-auto text-lg md:w-full">
            <form class="flex flex-col items-center justify-center gap-2">
                <input class="px-3 py-1.5 w-full text-lg border rounded-md border-gray-600 text-black" type="text" placeholder="Search a phrase...">

                <div class="flex flex-row items-center w-full gap-2 justify center">
                    <label for="sort" class="min-w-fit">Sort by:</label>
                    <select name="" id="sort" class="px-3 py-1.5 grow text-lg border rounded-md border-gray-600 text-black">
                        <option value="">Popularity</option>
                        <option value="">Date</option>
                        <option value="">Rating</option>
                        <option value="">Respondents</option>
                    </select>
                    <select name="" id="type" class="px-3 py-1.5 grow text-lg border rounded-md border-gray-600 text-black">
                        <option value="">Descending</option>
                        <option value="">Ascending</option>
                    </select>
                </div>

                <div class="flex flex-row items-center w-full gap-2 mb-3 justify center">
                    <label for="survey-tags" class="min-w-fit">Tags</label>
                    <div id="survey-tags" class="flex flex-row flex-wrap items-center max-w-full gap-y-2 gap-x-4">
                        <input class="w-32 px-3 py-1.5 h-auto text-lg border rounded-md border-gray-600 text-black">

                        <button id="add-tag" type="button" class="w-32 px-3 py-1.5 h-auto font-semibold text-white bg-blue-700 border border-transparent rounded">
                            <i class="fa-solid fa-plus"></i> Add tag
                        </button>
                    </div>
                </div>
                <button id="search" type="submit" class="w-full px-4 py-2 font-semibold text-white bg-green-700 border border-transparent rounded">
                    <i class="fa-solid fa-magnifying-glass"></i> Search
                </button>
            </form>

            <div class="flex flex-row flex-wrap w-full gap-5 px-4 mt-5 mb-9 md:w-full md:px-0">
                @foreach ($surveys as $survey)
                    <x-survey-card :survey="$survey" />
                @endforeach
            </div>

            {{ $surveys->links() }}
        </div>
    </x-section>

@endsection
