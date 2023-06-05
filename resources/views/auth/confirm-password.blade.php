@extends('layouts.layout')

@section('title', 'Confirm password')

@section('content')

    <div class="pt-12">
        <h2 class="text-4xl font-bold leading-tight text-center text-gray-800">
            Confirm password
        </h2>
    </div>

    <div class="max-w-screen-xl mx-auto mt-12 mb-16 md:w-5/6">
        <div class="py-12 bg-white shadow sm:rounded-lg">
            <div class="max-w-xl mx-auto">

                <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
                    {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
                </div>

                <form method="POST" action="{{ route('password.confirm') }}">
                    @csrf

                    <!-- Password -->
                    <div>
                        <x-input-label for="password" :value="__('Password')" />

                        <x-text-input id="password" class="block w-full mt-1" type="password" name="password" required autocomplete="current-password" />

                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div class="flex justify-end mt-4">
                        <x-primary-button>
                            {{ __('Confirm') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
