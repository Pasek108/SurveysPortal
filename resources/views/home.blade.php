@extends('layouts.layout')

@section('title', 'Home')

@section('content')

    <x-section>
        <div class="w-full text-center">
            <h2 class="w-full mb-4 text-4xl font-bold">About Us</h2>
            <p class="w-full mb-4 text-xl text-center">
                Welcome to SurveysPortal, the platform where you can create, discover, and participate in
                surveys on various topics for free. Our goal is to provide an interactive and engaging environment
                for survey enthusiasts and researchers and anyone interested in gathering valuable insights.
            </p>
        </div>
    </x-section>

    <x-section>
        <div class="w-full mb-10 md:w-7/12 md:mb-0">
            <h2 class="mb-4 text-4xl font-bold">What do we offer?</h2>
            <ul class="ml-5 text-xl list-disc">
                <li>Customizable and easy to create surveys.</li>
                <li>Advanced survey question types.</li>
                <li>Exploring variety of surveys created by others.</li>
                <li>Collecting data from a diverse pool of participants.</li>
                <li>Survey analytics and visualizations.</li>
                <li>Secure and private data handling.</li>
                <li>User-friendly and responsive experience</li>
            </ul>
            <p class="text-xl text-justify">
            </p>
        </div>

        <div class="flex items-center justify-center w-5/6 -my-10 md:w-5/12">
            <img src="imgs/Customer Survey-amico.svg" alt="" class="w-full md:w-4/5">
        </div>
    </x-section>

    <x-section>
        <div class="flex flex-col items-center justify-center">
            <h2 class="text-4xl font-bold text-center">Explore surveys</h2>

            <div class="relative z-0 flex flex-row my-5 border border-black rounded-lg">
                <button id="popular-button" class="px-5 py-2 font-bold text-white transition-colors duration-300 ease-in-out w-52 md:w-64">
                    Popular surveys
                </button>

                <button id="latest-button" class="px-5 py-2 font-bold transition-colors duration-300 ease-in-out w-52 md:w-64">
                    Latest surveys
                </button>

                <div id="indicator" class="absolute h-10 px-5 py-2 transition-transform duration-300 ease-in-out bg-blue-600 rounded-lg shadow-md -z-10 w-52 md:w-64"></div>
            </div>

            <div id="popular" class="flex flex-row flex-wrap w-screen gap-5 px-4 mt-5 mb-9 md:w-full md:px-0">
                @foreach ($popular as $survey)
                    <x-survey-card :survey="$survey" />
                @endforeach
            </div>

            <div id="latest" class="flex flex-row flex-wrap w-screen gap-5 px-4 mt-5 mb-9 md:w-full md:px-0" style="display: none">
                @foreach ($latest as $survey)
                    <x-survey-card :survey="$survey" />
                @endforeach
            </div>

            <a href="/search" class="text-xl text-blue-600 hover:underline">Click here to see more...</a>
        </div>
    </x-section>

    <x-section>
        <div class="flex flex-col md:flex-row">
            <div class="self-start mb-10 md:w-1/2 md:mb-0 md:mr-10">
                <h2 class="text-4xl font-bold">Join Us</h2>
                <p class="my-4 text-xl text-justify">
                    Join SurveysPortal today and embark on a journey of knowledge, opinion sharing, and meaningful data generation.
                    Start creating, exploring, and engaging with surveys that matter to you!
                </p>
                <a href="/login" class="self-end px-4 py-2 font-semibold text-green-700 bg-transparent border border-green-500 rounded hover:bg-green-700 hover:text-white hover:border-transparent" type="submit">Sign in</a>
            </div>

            <div class="self-start mb-10 md:w-1/2 md:mb-0">
                <h2 class="text-4xl font-bold">Start creating</h2>
                <p class="my-4 text-xl text-justify">
                    Whether you're a researcher looking to gather data, a business seeking customer feedback, or an individual
                    interested in expressing your opinions, SurveysPortal offers a user-friendly platform to meet your survey needs.
                </p>
                <a href="/create-survey" class="self-end px-4 py-2 font-semibold text-green-700 bg-transparent border border-green-500 rounded hover:bg-green-700 hover:text-white hover:border-transparent" type="submit">Create survey</a>
            </div>
    </x-section>

    <x-section>
        <div class="w-full text-center">
            <h2 class="mb-4 text-4xl font-bold">FAQ</h2>

            <div class="text-left">
                <details class="my-5 bg-white rounded-md shadow-md">
                    <summary class="p-4 text-xl font-bold cursor-pointer">How do I create a survey?</summary>
                    <p class="pt-2 pb-4 mx-4 -mt-2 text-xl border-t border-black cursor-default -pt-2">To create a survey, simply click on the "Create Survey" link in the navigation menu. Follow the step-by-step instructions to customize your survey questions, options, and settings.</p>
                </details>

                <details class="my-5 bg-white rounded-md shadow-md">
                    <summary class="p-4 text-xl font-bold cursor-pointer">Can I participate in surveys anonymously?</summary>
                    <p class="pt-2 pb-4 mx-4 -mt-2 text-xl border-t border-black cursor-default -pt-2">Yes, you have the option to participate in surveys anonymously. Your privacy is important to us, and we respect your choice to remain anonymous while providing valuable insights.</p>
                </details>

                <details class="my-5 bg-white rounded-md shadow-md">
                    <summary class="p-4 text-xl font-bold cursor-pointer">How can I view my survey results?</summary>
                    <p class="pt-2 pb-4 mx-4 -mt-2 text-xl border-t border-black cursor-default -pt-2">Once your survey has received responses, you can view the results by accessing the "My Surveys" section. Click on the survey you want to analyze, and you'll find a detailed breakdown of the responses.</p>
                </details>
            </div>
        </div>
    </x-section>

@endsection

<script src="{{ asset('storage/js/main_page.js') }}"></script>
