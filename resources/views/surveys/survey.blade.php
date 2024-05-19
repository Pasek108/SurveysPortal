@extends('layouts.layout')

@section('title', 'Survey')

@section('content')

    <div class="w-full min-h-screen py-12 text-lg">
        <div class="w-full mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
            <div class="w-full p-4 bg-white shadow sm:p-8 sm:rounded-lg">
                <div class="relative z-0 w-full">
                    <div class="flex flex-col md:flex-row">
                        <div class="flex flex-col items-start justify-start mb-2 md:mr-10 grow">
                            <h3 class="w-full mb-3 text-2xl font-bold break-words">
                                {{ $survey['title'] }}
                            </h3>

                            <p class="w-full overflow-hidden text-justify break-words">
                                {{ $survey['description'] == '' ? 'No description' : $survey['description'] }}
                            </p>
                        </div>

                        <div class="flex flex-row items-end justify-between md:justify-start md:flex-col min-w-fit md:mt-0 mt-5">
                            <div class="whitespace-nowrap">{{ $survey->countQuestions($survey->id) }} questions</div>
                            <div class="whitespace-nowrap">{{ $survey->countRespondents($survey->id) }} respondents</div>
                            <div class="whitespace-nowrap">{{ $survey->getRating($survey->id) }} <i class="fa-solid fa-star text-amber-400"></i></div>
                        </div>
                    </div>

                    <div class="flex flex-row mt-5 mb-7">
                        <div class="flex flex-col items-start justify-start mr-10 grow">
                            <h3 class="mb-1 text-lg font-bold">Tags:</h3>
                            <div class="flex flex-row flex-wrap">
                                @foreach ($survey->tags as $tag)
                                    <a href="/survey/search/" class="p-0.5 mr-1 mb-1 px-3 rounded-xl bg-blue-900 text-white cursor-pointer hover:underline">#{{ $tag['name'] }}</a>
                                @endforeach
                            </div>
                        </div>

                        <div class="flex flex-col items-end justify-start">
                            <div class="text-lg font-bold whitespace-nowrap">Created by:</div>
                            <a href="/profile/{{ $survey->owner->id }}" class="text-lg text-right break-words cursor-pointer hover:underline">
                                {{ $survey->owner->name }}
                            </a>
                        </div>
                    </div>

                    <div class="flex flex-row items-center justify-between">
                        <div class="min-w-fit">
                            @if ($survey->owner->id != intval(auth()->user()->id))
                                <a href="/survey/{{ $survey->id }}/fill" class="self-end px-4 py-2 font-semibold text-green-700 bg-transparent border border-green-500 rounded hover:bg-green-700 hover:text-white hover:border-transparent" type="submit">
                                    Fill survey
                                </a>
                            @endif
                        </div>

                        <div class="flex flex-row items-end justify-end grow">
                            @if ($survey->owner->id == intval(auth()->user()->id))
                                <a href="/survey/{{ $survey->id }}/edit" class="self-end px-4 py-2 mr-2 font-semibold text-green-700 bg-transparent border border-green-500 rounded hover:bg-green-700 hover:text-white hover:border-transparent" type="submit">
                                    Edit survey
                                </a>
                            @endif

                            @if ($survey->owner->id == auth()->user()->id)
                                <a href="/survey/{{ $survey->id }}/stats" class="self-end px-4 py-2 font-semibold text-green-700 bg-transparent border border-green-500 rounded hover:bg-green-700 hover:text-white hover:border-transparent" type="submit">
                                    Show statictics
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
