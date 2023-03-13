@extends('layout')

@section('content')
    <div class="flex flex-col justify-center items-center">
        <section class="w-full p-4 py-10">
            <div class="flex flex-col md:w-1/2 w-full max-w-screen-xl mx-auto">
                <form class="p-8 border rounded-md border-gray-400 bg-slate-100">
                    <h2 class="text-2xl text-center font-bold">Register</h2>
                    <h4 class="mb-4 text-center">Create an account to create and manage surveys</h4>

                    <div class="mb-3">
                        <label class="block mb-1" for="floatingInput">Email address</label>
                        <input class="px-3 py-1.5 w-full border rounded border-gray-400" type="email" class="form-control"
                            id="floatingInput" placeholder="name@example.com">
                    </div>

                    <div class="mb-3">
                        <label class="block mb-1" for="floatingPassword">Password</label>
                        <input class="px-3 py-1.5 w-full border rounded border-gray-400" type="password"
                            class="form-control" id="floatingPassword" placeholder="Password">
                    </div>

                    <div class="mb-6">
                        <label class="block mb-1" for="floatingPassword">Confirm password</label>
                        <input class="px-3 py-1.5 w-full border rounded border-gray-400" type="password"
                            class="form-control" id="floatingPassword" placeholder="Password">
                    </div>

                    <button
                        class="w-full mb-8 bg-green-600 hover:bg-green-700 text-green-700 font-bold text-white py-2 px-4 border border-green-500 border-transparent rounded"
                        type="submit">Sign up</button>

                    <span>Already have an account? <a href="/login" class="text-blue-600 hover:underline">Log in
                            here</a></span>
                </form>
            </div>
        </section>
    </div>
@endsection
