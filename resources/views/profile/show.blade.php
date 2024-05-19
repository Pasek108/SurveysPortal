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
                <div class="flex flex-row items-start justify-start w-full gap-5 text-lg">
                    <div class="grow">
                        <div class=""><span class="font-bold">Username:</span> {{ $user->name }}</div>
                        <div class=""><span class="font-bold ">Email: </span>{{ $user->email }}</div>
                    </div>

                    <div class="flex flex-col items-start justify-start gap-2 w-max-fit">
                        @if (auth()->user()->id === $user->id)
                            <a href="/profile/edit" class="w-full px-4 py-2 text-base font-semibold text-center text-green-700 bg-transparent border border-green-500 rounded hover:bg-green-700 hover:text-white hover:border-transparent" type="submit">
                                Edit profile
                            </a>
                        @endif
                        @if (auth()->user()->id === $user->id && auth()->user()->role->name != 'user')
                            <a href="/admin-panel/" class="w-full px-4 py-2 text-base font-semibold text-center text-green-700 bg-transparent border border-green-500 rounded hover:bg-green-700 hover:text-white hover:border-transparent" type="submit">
                                Admin panel
                            </a>
                        @endif

                        </button>
                    </div>
                </div>

                <div class="w-full mt-8">
                    <div class="flex flex-row items-center justify-between w-full">
                        <h3 class="text-2xl font-bold">User surveys </h3>
                        <a href="/survey/create" class="px-4 py-2 font-semibold text-center text-green-700 bg-transparent border border-green-500 rounded hover:bg-green-700 hover:text-white hover:border-transparent" type="submit">
                            Create survey
                        </a>
                    </div>

                    <div class="flex flex-row flex-wrap w-full gap-5 px-4 mt-2 mb-9 md:w-full md:px-0">
                        @foreach ($user->surveys as $survey)
                            <x-survey-card :survey="$survey" />
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
