@extends('layouts.layout')

@section('title', 'Profile')

@section('content')

    <div class="pt-12">
        <h2 class="text-4xl font-bold leading-tight text-center text-gray-800">
            Profile {{ $user->name }}
        </h2>
    </div>

    <div class="py-12">
        <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
            <div class="p-4 bg-white shadow sm:p-8 sm:rounded-lg">
                <div class="max-w-xl">
                    @if (auth()->user()->id === $user->id)
                    <a href="/profile/edit" class="self-end px-4 py-2 font-semibold text-green-700 bg-transparent border border-green-500 rounded hover:bg-green-700 hover:text-white hover:border-transparent" type="submit">
                        Edit profile
                    </a>
                    @endif

                    <a href="/survey/create" class="self-end px-4 py-2 font-semibold text-green-700 bg-transparent border border-green-500 rounded hover:bg-green-700 hover:text-white hover:border-transparent" type="submit">
                        Create survey
                    </a>

                    <div class="mt-5">
                        <h3 class="text-2xl font-bold">Your surveys</h3>
                        <div class="flex flex-row flex-wrap w-screen gap-5 px-4 mb-9 md:w-full md:px-0">
                            @foreach ($user->surveys as $survey)
                                <x-survey-card :survey="$survey" />
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
