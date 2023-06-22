@extends('layouts.layout')

@section('title', 'Error 403')

@section('content')

    <div class="flex flex-col items-center w-full py-16 bg-white align-center">
        <div class="flex flex-col items-center max-w-xl align-center">
            <img class="absolute text-gray-400 -z-10 w-96" src="/imgs/error.png" alt="error_image">

            <h2 class="font-bold text-red-700 text-7xl">403</h2>

            <p class="font-bold text-center text-red-700">
                <span class="bg-white">Access denied/forbidden.</span>
            </p>

            <p class="max-w-full mb-4 font-bold text-center text-red-700">
                <span class="bg-white">You tried to access a page you did not have prior authorization for.</span>
            </p>

            <a href="/" class="px-4 py-2 font-bold text-center text-green-700 bg-green-600 border border-transparent rounded w-44 mt-52 hover:bg-green-700">
                Back to homepage
            </a>
        </div>
    </div>

@endsection
