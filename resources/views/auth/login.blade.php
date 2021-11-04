@extends('layouts.master')

@section('title', 'Login page')



@section('content')



<div class='d-flex d-flex justify-content-center border border-2 rounded border-warning p-2'>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <!-- Validation Errors -->
    
    <x-auth-validation-errors class="mb-4 col-12" :errors="$errors" />
    
    <br />

    <form method="POST" action="{{ route('login') }}" class='border border-1 p-5 rounded mx-2 col-12'>
        @csrf

        <!-- Email Address -->
        <div class='row'>
            <x-label for="username" :value="__('Username')" class='col-4' />

            <x-input id="username" class="block mt-1 w-full mr-0 col-8" name="username" type="text" :value="old('username')" required autofocus />
        </div>

        <!-- Password -->
        <div class="mt-4 row">
            <x-label for="password" :value="__('Password')" class='col-4' />

            <x-input id="password" class="block mt-1 w-full mr-0 col-8" type="password" name="password" required autocomplete="current-password" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
            <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                {{ __('Forgot your password?') }}
            </a>
            @endif

            <x-button class="ml-3 btn btn-primary">
                {{ __('Log in') }}
            </x-button>
        </div>
    </form>

</div>

@endsection