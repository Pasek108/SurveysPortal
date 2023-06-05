@extends('layouts.layout')

@section('title', 'Forgot password')

@section('content')

    <div class="pt-12">
        <h2 class="text-4xl font-bold leading-tight text-center text-gray-800">
            Forgot password
        </h2>
    </div>

    <div class="max-w-screen-xl mx-auto mt-12 mb-16 md:w-5/6">
        <div class="py-12 bg-white shadow sm:rounded-lg">
            <div class="max-w-xl mx-auto">

                <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
                    {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                </div>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <!-- Email Address -->
                    <div>
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="block w-full mt-1" type="email" name="email" :value="old('email')" required autofocus />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-primary-button>
                            {{ __('Email Password Reset Link') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
