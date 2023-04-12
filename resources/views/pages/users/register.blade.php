<x-layout title="Register" show_contact="true">
    <div class="flex flex-col justify-center items-center">
        <section class="w-full p-4 py-10">
            <div class="flex flex-col md:w-1/2 w-full max-w-screen-xl mx-auto">
                <form action="/register" method="POST" class="p-8 border rounded-md border-gray-400 bg-slate-100">
                    @csrf
                    <h2 class="text-2xl text-center font-bold">Register</h2>
                    <h4 class="mb-4 text-center">Create an account to create and manage surveys</h4>

                    <x-input label="Email address" type="email" name="email" placeholder="name@example.com"
                        required="true" />
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror

                    <x-input label="Name" type="name" name="name" placeholder="name" required="true" />
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror

                    <x-input label="Password" type="password" name="password" placeholder="Password" required="true" />
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror

                    <x-input label="Confirm password" type="password" name="password_confirmation"
                        placeholder="Confirm password" required="true" />
                    @error('password-confirmation')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror

                    <button
                        class="w-full my-4 bg-green-600 hover:bg-green-700 font-bold text-white py-2 px-4 rounded"
                        type="submit">Sign up</button>

                    <span>Already have an account? <a href="/login" class="text-blue-600 hover:underline">Log in
                            here</a></span>
                </form>
            </div>
        </section>
    </div>
</x-layout>
