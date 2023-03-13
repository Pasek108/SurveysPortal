@extends('layout')

@section('content')
<div class="flex flex-col justify-center items-center">
    <section class="w-full p-4 py-10">
        <div class="flex flex-col md:w-1/2 w-full max-w-screen-xl mx-auto">
            <div class="flex flex-col justify-center items-center">
                <input class="px-3 py-1.5 w-full border rounded-md border-gray-600 text-black" type="text" placeholder="Search a phrase...">
            </div>
        </div>
    </section>
</div>

@endsection
