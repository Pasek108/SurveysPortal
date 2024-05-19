@extends('layouts.layout')

@section('title', 'Fill survey')

@section('content')

    @php
        $did_user_vote = false;
        foreach ($survey->questions[0]->userAnswers as $user_answer) {
            if ($user_answer->user_id == auth()->user()->id) {
                $did_user_vote = true;
            }
        }
    @endphp

    @if (!$did_user_vote)
        <div id="fill-survey" class="w-full min-h-screen py-12 text-lg">
            <div class="w-full mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">

                <div class="w-full p-4 bg-white shadow sm:p-8 sm:rounded-lg">
                    <div class="relative z-0 w-full">
                        <div class="flex flex-col items-start justify-start mb-2 md:mr-10 grow">
                            <h3 class="w-full mb-3 text-3xl font-bold break-words">
                                {{ $survey['title'] }}
                            </h3>

                            <p class="w-full overflow-hidden text-justify break-words">
                                {{ $survey['description'] == '' ? 'No description' : $survey['description'] }}
                            </p>
                        </div>
                    </div>
                </div>

                @for ($i = 0; $i < count($survey->questions); $i++)
                    @php $question = $survey->questions[$i] @endphp
                    <div class="relative z-0 w-full p-4 bg-white shadow preserve-3d sm:p-8 sm:rounded-lg question" data-questionid="{{ $question->id }}" data-type="{{ $question->type->name }}">
                        <div class="w-full">
                            <h3 class="w-full mb-2 text-xl font-bold text-white">
                                Question {{ $i + 1 }}/{{ count($survey->questions) }}
                            </h3>

                            <h3 class="w-full mb-2 text-2xl font-bold break-words">
                                {{ $question['question'] }}
                            </h3>

                            <p class="w-full mb-5 overflow-hidden text-justify break-words">
                                {{ $question['description'] == '' ? 'No description' : $question['description'] }}
                            </p>

                            <div class="flex flex-col items-start justify-start">
                                @switch($question->type->name)
                                    @case('range')
                                        <div class="flex flex-row items-center justify-between w-full">
                                            <div class="font-bold">{{ explode('-', $question->answers[0]->text)[0] }}</div>
                                            <div class="font-bold">{{ explode('-', $question->answers[0]->text)[1] }}</div>
                                        </div>

                                        <input class="py-1.5 w-full border rounded border-gray-400 text-lg cursor-pointer" type="range" name="" step="1" value="{{ explode('-', $question->answers[0]->text)[0] }}" min="{{ explode('-', $question->answers[0]->text)[0] }}" max="{{ explode('-', $question->answers[0]->text)[1] }}">

                                        <div class="relative w-full">
                                            &nbsp;
                                            <div class="absolute top-0 text-center indicator">
                                                {{ explode('-', $question->answers[0]->text)[0] }}
                                            </div>
                                        </div>
                                    @break

                                    @case('single choice')
                                        @foreach ($question->answers as $answer)
                                            <div class="flex flex-row items-center justify-start w-full px-4 py-1.5 border rounded border-gray-400 text-lg mb-3">
                                                <input class="cursor-pointer" type="radio" name="q-{{ $question->id }}" id="a{{ $answer->id }}">
                                                <label for="a{{ $answer->id }}" class="ml-4 cursor-pointer grow">{{ $answer->text }}</label>
                                            </div>
                                        @endforeach
                                    @break

                                    @case('multiple choice')
                                        @foreach ($question->answers as $answer)
                                            <div class="flex flex-row items-center justify-start w-full px-4 py-1.5 border rounded border-gray-400 text-lg mb-3">
                                                <input class="cursor-pointer" type="checkbox" name="q-{{ $question->id }}" id="a{{ $answer->id }}">
                                                <label for="a{{ $answer->id }}" class="ml-4 cursor-pointer grow">{{ $answer->text }}</label>
                                            </div>
                                        @endforeach
                                    @break

                                    @case('single choice or text')
                                        @foreach ($question->answers as $answer)
                                            <div class="flex flex-row items-center justify-start w-full px-4 py-1.5 border rounded border-gray-400 text-lg mb-3">
                                                <input class="cursor-pointer" type="radio" name="q-{{ $question->id }}" id="a{{ $answer->id }}">
                                                <label for="a{{ $answer->id }}" class="ml-4 cursor-pointer grow">{{ $answer->text }}</label>
                                            </div>
                                        @endforeach
                                        <input class="px-4 py-1.5 w-full border rounded border-gray-400 text-lg" type="text" name="" placeholder="Type answer...">
                                    @break

                                    @case('multiple choice or text')
                                        @foreach ($question->answers as $answer)
                                            <div class="flex flex-row items-center justify-start w-full px-4 py-1.5 border rounded border-gray-400 text-lg mb-3">
                                                <input class="cursor-pointer" type="checkbox" name="q-{{ $question->id }}" id="a{{ $answer->id }}">
                                                <label for="a{{ $answer->id }}" class="ml-4 cursor-pointer grow">{{ $answer->text }}</label>
                                            </div>
                                        @endforeach
                                        <input class="px-4 py-1.5 w-full border rounded border-gray-400 text-lg" type="text" name="" placeholder="Type answer...">
                                    @break

                                    @default
                                        <input class="px-4 py-1.5 w-full border rounded border-gray-400 text-lg" type="text" name="" placeholder="Type answer...">
                                @endswitch

                            </div>
                        </div>

                        <div class="absolute origin-bottom-left card-line-back bg-blue-900 top-3 sm:top-7 -left-[10px] -z-10 h-9 w-9"></div>
                        <div class="absolute top-3 sm:top-7 -left-[6px] w-80 -skew-x-[15deg] bg-blue-600 -z-10 h-9"></div>

                    </div>
                @endfor

                <div class="w-full p-4 bg-white shadow sm:p-8 sm:rounded-lg">
                    <div class="relative z-0 w-full">
                        <div class="flex flex-col items-center justify-center grow">
                            <h3 class="text-2xl font-bold">How do you rate this survey?</h3>
                            <div class="flex flex-row items-center justify-center my-6 space-x-2 text-5xl font-bold">
                                <i class="cursor-pointer fa-regular fa-star"></i>
                                <i class="cursor-pointer fa-regular fa-star"></i>
                                <i class="cursor-pointer fa-regular fa-star"></i>
                                <i class="cursor-pointer fa-regular fa-star"></i>
                                <i class="cursor-pointer fa-regular fa-star"></i>
                            </div>

                            <div class="flex flex-row items-center justify-center gap-2 mb-8">
                                <label for="no_rating">I don't want to rate this survey</label>
                                <input type="checkbox" id="no_rating">
                            </div>


                            <button id="submit_survey" type="submit" class="w-1/2 px-4 py-2 font-semibold text-green-700 bg-transparent border border-green-500 rounded hover:bg-green-700 hover:text-white hover:border-transparent">
                                <i class="fa-solid fa-check"></i> Submit survey
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div id="thank_you" class="w-full min-h-screen py-12 text-lg" style="{{ !$did_user_vote ? 'display: none' : '' }}">
        <div class="w-full mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
            <div class="w-full p-4 bg-white shadow sm:p-8 sm:rounded-lg">
                <div class="relative z-0 w-full">
                    <div class="flex flex-col items-center justify-center grow">
                        <h3 class="text-3xl font-bold">That's it!</h3>
                        <div class="flex flex-row items-center justify-center my-6 space-x-2 text-xl">
                            {{ $survey->end_message }}
                        </div>

                        <div class="flex md:flex-row flex-col items-center justify-center w-full gap-2 mt-4">
                            <a href="/report/{{ $survey->id }}" class="w-full md:w-1/2 px-4 py-2 font-semibold text-red-700 bg-transparent border border-red-500 rounded hover:bg-red-700 hover:text-white hover:border-transparent">
                                <i class="fa-solid fa-triangle-exclamation"></i> Report this survey
                            </a>

                            <a href="/" class="w-full md:w-1/2 px-4 py-2 font-semibold text-green-700 bg-transparent border border-green-500 rounded hover:bg-green-700 hover:text-white hover:border-transparent">
                                Back to home page
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section id="messages" class="fixed bottom-0 right-0 z-50 flex flex-col-reverse items-center justify-center w-full max-w-full gap-1 p-4 md:w-1/2"></section>
@endsection

<script>
    const user_id = {{ auth()->user()->id }};
    const survey_id = {{ $survey->id }};
</script>

<script src="/js/survey_creator/Messages.js"></script>
<script src="/js/fill_survey.js"></script>
