@extends('layouts.layout')

@section('title', 'Error 404')

@section('content')

    <div class="max-w-screen-xl mx-auto mt-12 mb-16 md:w-5/6">
        <div class="p-4 bg-white shadow sm:rounded-lg">
            <div class="flex flex-col items-center w-full py-16 bg-white align-center">
                <div class="flex flex-col items-center max-w-xl align-center">
                    <img class="absolute text-gray-400 w-[26rem]" src="imgs/error.png" alt="error_image">

                    <h2 class="z-10 font-bold text-red-700 text-7xl">404</h2>

                    <p class="z-10 text-xl font-bold text-center text-red-700">
                        <span class="bg-white">Looks like this page does not exist.</span>
                    </p>

                    <p class="z-10 max-w-full mb-4 text-xl font-bold text-center text-red-700">
                        <span class="bg-white">Please check the URL again or back to the <br>homepage</span>
                    </p>

                    <a href="/" class="px-4 py-2 font-bold text-center text-white bg-green-600 border border-transparent rounded mt-52 w-44 hover:bg-green-700">
                        Back to homepage
                    </a>
                </div>
            </div>
        </div>
    </div>

@endsection
