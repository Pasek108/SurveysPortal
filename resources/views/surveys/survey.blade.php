@extends('layouts.layout')

@section('title', 'Survey')

@section('content')

<div class="w-full min-h-screen py-12">
    <div class="w-full mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
        <div class="w-full p-4 bg-white shadow sm:p-8 sm:rounded-lg">
            <div class="relative z-0 w-full preserve-3d">
                <div class="absolute origin-bottom-left bg-blue-900 -top-1 card-line-back -left-10 -z-10 h-9 w-9"></div>
                <div class="absolute -top-1 -left-9 w-[calc(100%-3rem)] -skew-x-[15deg] bg-blue-600 -z-10 h-9"></div>

                <h3 class="text-white mb-3 w-[calc(100%-3rem)] overflow-hidden text-xl font-bold cursor-pointer whitespace-nowrap text-ellipsis hover:underline">
                    {{ $survey['title'] }}
                </h3>

                <p class="w-full h-[4.75rem] line-clamp-3 text-ellipsis text-justify overflow-hidden">
                    {{ $survey['description'] }}
                </p>
            </div>
        </div>
    </div>
</div>

@endsection
