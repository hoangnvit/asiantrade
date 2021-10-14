@extends('layouts.master')

@section('title', 'Register page')



@section('content')


<div class='d-flex d-flex justify-content-center border border-2 rounded border-warning p-2'>

    


    <div>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <!-- Validation Errors -->
    <x-auth-validation-errors class="mb-4" :errors="$errors" />

    <form method="POST" action="{{ route('password.email') }}" class='border border-1 p-5 rounded mx-2'>
        @csrf

        <!-- Email Address -->
        <div>
            <x-label for="email" :value="__('Email')" />

            <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-button class='btn btn-primary'>
                {{ __('Email Password Reset Link') }}
            </x-button>
        </div>
    </form>
</div>

@endsection