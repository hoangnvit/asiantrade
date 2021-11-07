@extends('layouts.master')

@section('title', 'Register page')



@section('content')

<div class='d-flex d-flex justify-content-center rounded'>
    <!-- Session Status -->
     <x-auth-session-status class="mb-4" :status="session('status')" />

    <!-- Validation Errors -->
    
    <x-auth-validation-errors class="mb-4" :errors="$errors" />
    


</div>

<div class='d-flex d-flex justify-content-center p-2'>



    <form method="POST" action="{{ route('register') }}" class='border border-1 p-5 rounded mx-2'>
        @csrf

        <!-- Username -->
        <div class='row'>
            <x-label for="username" :value="__('Username')" class='col-4' />

            <x-input id="username" class="block mt-1 w-full col-8" type="text" name="username" :value="old('username')" required autofocus />
        </div>

        <!-- Email Address -->
        <div class="mt-4 row">
            <x-label for="email" :value="__('Email')" class='col-4' />

            <x-input id="email" class="block mt-1 w-full col-8" type="email" name="email" :value="old('email')" required />
        </div>

        <!-- Password -->
        <div class="mt-4 row">
            <x-label for="password" :value="__('Password')" class='col-4' />

            <x-input id="password" class="block mt-1 w-full col-8" type="password" name="password" required autocomplete="new-password" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4 row">
            <x-label for="password_confirmation" :value="__('Confirm Password')" class='col-4' />

            <x-input id="password_confirmation" class="block mt-1 w-full col-8" type="password" name="password_confirmation" required />
        </div>

        <!-- firstname -->
        <div class='row'>
            <x-label for="fname" :value="__('Firstname')" class='col-4' />

            <x-input id="fname" class="block mt-1 w-full col-8" type="text" name="fname" :value="old('fname')" required autofocus />
        </div>

        <!-- lname -->
        <div class='row'>
            <x-label for="lname" :value="__('Lastname')" class='col-4' />

            <x-input id="lname" class="block mt-1 w-full col-8" type="text" name="lname" :value="old('lname')" required autofocus />
        </div>

        <!-- Address -->
        <div class='row'>
            <x-label for="address" :value="__('Address')" class='col-4' />

            <x-input id="address" class="block mt-1 w-full col-8" type="text" name="address" :value="old('address')" required autofocus />
        </div>

        <!-- Username -->
        <div class='row'>
            <x-label for="postalcode" :value="__('Postalcode')" class='col-4' />

            <x-input id="postalcode" class="block mt-1 w-full col-8" type="text" name="postalcode" :value="old('postalcode')" required autofocus />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-button class="ml-4 btn btn-primary">
                {{ __('Register') }}
            </x-button>
        </div>
    </form>

</div>

@endsection