<x-layout title="Login" show_contact="true">
    <div class="flex flex-col justify-center items-center">
        <section class="w-full p-4 py-10">
            <div class="flex flex-col md:w-1/2 w-full max-w-screen-xl mx-auto">
                <form method="POST" action="/auth" class="p-8 border rounded-md border-gray-400 bg-slate-100">
                    @csrf
                    <h2 class="text-2xl text-center font-bold">Login</h2>
                    <h4 class="mb-4 text-center">Log into your account to create and manage surveys</h4>

                    <x-input label="Email address" type="email" name="email" placeholder="name@example.com" />
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror

                    <x-input label="Password" type="password" name="password" placeholder="Password" />
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror

                    <div class="mb-6">
                        <input class="inline" type="checkbox" value="remember-me" name="remember-me" id="remember-me" value="1">
                        <label class="inline" for="remember-me">Remember me</label>
                    </div>

                    <button
                        class="w-full mb-8 bg-green-600 hover:bg-green-700 font-bold text-white py-2 px-4 rounded"
                        type="submit">Log in</button>

                    <span>Don't have an account? <a href="/register" class="text-blue-600 hover:underline">Register
                            here</a></span>
                </form>
            </div>
        </section>
    </div>
</x-layout>
