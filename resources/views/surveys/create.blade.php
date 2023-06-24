@extends('layouts.layout')

@section('title', 'Survey creator')

@section('content')

    <div class="flex flex-col items-center justify-start min-h-screen">
        <section class="w-full p-4 py-10">
            <div class="flex flex-col w-full max-w-screen-xl mx-auto md:w-2/3">
                <div id="create-survey" class="overflow-hidden text-lg border border-gray-400 rounded-md group active-1 bg-slate-100">
                    <!-- --------------- section buttons --------------- -->
                    <div class="flex" id="sections">
                        <button type="button" class="grow p-2 border-r group-[:not(.active-1)]:bg-blue-600 group-[:not(.active-1)]:text-white text-center">
                            Informations
                        </button>
                        <button type="button" class="grow p-2 border-r group-[:not(.active-2)]:bg-blue-600 group-[:not(.active-2)]:text-white text-center">
                            Questions
                        </button>
                        <button type="button" class="grow p-2 group-[:not(.active-3)]:bg-blue-600 group-[:not(.active-3)]:text-white text-center">
                            Settings
                        </button>
                    </div>

                    <!-- --------------- informations --------------- -->
                    <section class="p-8 group-[:not(.active-1)]:hidden">
                        <h2 class="mb-2 text-2xl font-bold text-center">Fill informations</h2>

                        <x-input label="Title" type="text" name="title" placeholder="Survey title" required="true" />

                        <div class="mb-3">
                            <label class="block mb-1">Tags</label>
                            <div id="survey-tags" class="flex flex-row flex-wrap items-center max-w-full gap-y-2 gap-x-4">
                                <input list="tags" name="ice-cream-choice" class="w-32 h-auto py-1 pl-4 pr-1 text-lg border border-gray-400 rounded tag-input">

                                <button id="add-tag" type="button" class="w-32 font-semibold text-green-700 bg-transparent border border-green-500 rounded h-9 hover:bg-green-700 hover:text-white hover:border-transparent">
                                    <i class="fa-solid fa-plus"></i> Add tag
                                </button>
                            </div>

                            <datalist id="tags">
                                @foreach ($tags as $tag)
                                    <option value="{{ $tag->name }}">
                                @endforeach
                            </datalist>
                        </div>

                        <x-input label="Start date" type="datetime-local" name="start_date" placeholder="" />
                        <x-input label="End date" type="datetime-local" name="end_date" placeholder="" />

                        <div class="mb-3">
                            <label class="block mb-1" for="description">Description</label>
                            <textarea class="px-4 py-1.5 w-full border text-lg rounded border-gray-400" id="description" name="description" placeholder="Survey description" rows="5"></textarea>
                        </div>

                        <div class="flex justify-end space-x-3">
                            <div class="w-1/2"></div>
                            <button type="button" class="w-1/2 px-4 py-2 font-semibold text-green-700 bg-transparent border border-green-500 rounded next hover:bg-green-700 hover:text-white hover:border-transparent">
                                Next
                                <i class="ml-1 -mr-1 fa-solid fa-arrow-right"></i>
                            </button>
                        </div>
                    </section>

                    <!-- --------------- questions --------------- -->
                    <section class="p-8 group-[:not(.active-2)]:hidden">
                        <h2 class="mb-2 text-2xl font-bold text-center">Create questions (min 1, max 60)</h2>

                        <div class="flex flex-col items-center justify-center py-4">
                            <ul id="questions-list" class="flex flex-col items-start justify-start w-full mb-3">

                            </ul>

                            <button id="add-question" type="button" class="w-1/2 px-4 py-2 font-semibold text-green-700 bg-transparent border border-green-500 rounded hover:bg-green-700 hover:text-white hover:border-transparent">
                                <i class="ml-1 -mr-1 fa-solid fa-plus"></i>
                                Add question
                            </button>
                        </div>

                        <div class="flex justify-center space-x-3">
                            <button type="button" class="w-1/2 px-4 py-2 font-semibold text-green-700 bg-transparent border border-green-500 rounded prev hover:bg-green-700 hover:text-white hover:border-transparent">
                                <i class="mr-1 -ml-1 fa-solid fa-arrow-left"></i>
                                Prev
                            </button>
                            <button type="button" class="w-1/2 px-4 py-2 font-semibold text-green-700 bg-transparent border border-green-500 rounded next hover:bg-green-700 hover:text-white hover:border-transparent">
                                Next
                                <i class="ml-1 -mr-1 fa-solid fa-arrow-right"></i>
                            </button>
                        </div>
                    </section>

                    <!-- --------------- settings --------------- -->
                    <section class="p-8 group-[:not(.active-3)]:hidden">
                        <h2 class="mb-2 text-2xl font-bold text-center">Change settings</h2>

                        <x-input label="Admin password" type="password" name="admin_password" placeholder="Password" required="true" />
                        <x-input label="Access password" type="password" name="access_password" placeholder="Password" />
                        <div class="mb-3">
                            <label class="block mb-1" for="end_message">End message</label>
                            <textarea class="px-4 py-1.5 w-full border rounded border-gray-400" id="end_message" name="end_message" placeholder="Survey end message" rows="5">Thanks for taking the survey</textarea>
                        </div>
                        <div class="mb-3">
                            <input class="" type="checkbox" value="allow_not_logged" name="allow_not_logged" id="allow_not_logged" value="1">
                            <label class="inline" for="allow_not_logged">Allow not logged users</label>
                        </div>

                        <div class="flex justify-end space-x-3">
                            <button type="button" class="w-1/2 px-4 py-2 font-semibold text-green-700 bg-transparent border border-green-500 rounded prev hover:bg-green-700 hover:text-white hover:border-transparent">
                                <i class="mr-1 -ml-1 fa-solid fa-arrow-left"></i>
                                Prev
                            </button>
                            <button id="create_survey" type="submit" class="w-1/2 px-4 py-2 font-semibold text-green-700 bg-transparent border border-green-500 rounded hover:bg-green-700 hover:text-white hover:border-transparent">
                                Create survey
                            </button>
                        </div>
                    </section>
                </div>
            </div>
        </section>
    </div>

    <!-- --------------- new question modal --------------- -->
    <section id="question-modal" class="absolute top-0 left-0 z-10 flex flex-row items-start justify-start w-full h-full bg-black bg-opacity-50" style="display: none">
        <div class="sticky top-0 w-full max-h-screen p-4 py-10 overflow-y-scroll">
            <div class="flex flex-col w-full max-w-screen-xl p-8 mx-auto overflow-hidden text-lg border border-gray-400 rounded-md md:w-2/3 bg-slate-100">
                <h3 class="mb-2 text-2xl font-bold text-center">Add new question</h3>

                <x-input label="Question" type="text" name="question" placeholder="Question" />

                <div class="mb-3">
                    <label class="block mb-1" for="description">Description</label>
                    <textarea class="px-4 py-1.5 text-lg w-full border rounded border-gray-400" id="description" name="description" placeholder="Question description" rows="5"></textarea>
                </div>

                <div class="mb-3">
                    <label class="block mb-1" for="type">Type</label>
                    <select name="type" id="type" class="px-4 py-1.5 w-full border border-gray-400 rounded text-lg">
                        @foreach ($types as $type)
                            <option value="{{ $type->name }}">{{ $type->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div id="range" class="flex flex-row items-center justify-between gap-4 mb-6" style="display: none">
                    <div class="flex flex-row items-center justify-between w-1/2 gap-2">
                        <label class="inline-block mb-1" for="from">From</label>
                        <input class="px-4 py-1.5 w-full border rounded border-gray-400 text-lg" type="number" id="from" name="from" value="0">
                    </div>
                    <div class="flex flex-row items-center justify-between w-1/2 gap-2">
                        <label class="inline-block mb-1" for="to">To</label>
                        <input class="px-4 py-1.5 w-full border rounded border-gray-400 text-lg" type="number" id="to" name="to" value="10">
                    </div>
                </div>

                <div id="choice" class="mb-6" style="display: none">
                    <div class="flex flex-row items-center justify-between w-full gap-2 mb-2 choice1">
                        <label class="inline-block mb-1" for="a1">1.</label>
                        <input class="px-4 py-1.5 w-full border rounded border-gray-400 text-lg" type="text" id="a1" name="a1" placeholder="Choice 1">
                        <div class="w-12 h-10 "></div>
                    </div>
                    <div class="flex flex-row items-center justify-between w-full gap-2 mb-2 choice2">
                        <label class="inline-block mb-1" for="a2">2.</label>
                        <input class="px-4 py-1.5 w-full border rounded border-gray-400 text-lg" type="text" id="a2" name="a2" placeholder="Choice 2">
                        <div class="w-12 h-10"></div>
                    </div>

                    <button id="add-choice" type="button" class="w-1/2 px-4 py-1.5 font-semibold text-green-700 bg-transparent border border-green-500 rounded hover:bg-green-700 hover:text-white hover:border-transparent">
                        <i class="fa-solid fa-plus"></i> Add choice
                    </button>
                </div>

                <div class="flex flex-row items-center justify-between gap-4">
                    <button id="cancel" type="submit" class="w-1/2 px-4 py-2 font-semibold text-red-700 bg-transparent border border-red-500 rounded hover:bg-red-700 hover:text-white hover:border-transparent">
                        <i class="fa-solid fa-xmark"></i> Cancel
                    </button>

                    <button id="create" type="submit" class="w-1/2 px-4 py-2 font-semibold text-green-700 bg-transparent border border-green-500 rounded hover:bg-green-700 hover:text-white hover:border-transparent">
                        <i class="fa-solid fa-check"></i> Create
                    </button>
                </div>
            </div>
        </div>
    </section>

    <section id="messages" class="fixed bottom-0 right-0 z-50 flex flex-col-reverse items-center justify-center w-full max-w-full gap-1 p-4 md:w-1/2"></section>

@endsection

<script src="/js/survey_creator/Messages.js"></script>
<script src="/js/survey_creator/ChoiceType.js"></script>
<script src="/js/survey_creator/RangeType.js"></script>
<script src="/js/survey_creator/Question.js"></script>
<script src="/js/survey_creator/QuestionModal.js"></script>
<script src="/js/survey_creator/SurveyTags.js"></script>
<script src="/js/survey_creator/SurveyCreator.js"></script>

@if (!empty($survey_data) && isset($survey_data))
    <script>
        const survey_data = {!! json_encode($survey_data, JSON_HEX_TAG) !!};
        const link = "/survey/" + {{ $survey_id }};
    </script>
    <script src="/js/edit_survey.js"></script>
@else
    <script src="/js/create_survey.js"></script>
@endif
