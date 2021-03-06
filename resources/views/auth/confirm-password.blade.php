@extends('layouts.master')

@section('title', 'Confirm Password Page')



@section('content')


<div class='d-flex d-flex justify-content-center rounded'>
    <!-- Session Status -->
    <!-- <x-auth-session-status class="mb-4" :status="session('status')" /> -->

    <!-- Validation Errors -->
    
    <x-auth-validation-errors class="mb-2" :errors="$errors" />
    


</div>
<div class='d-flex d-flex justify-content-center  p-2'>
    <x-slot name="logo">
        <a href="/">
            <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
        </a>
    </x-slot>

    <div class="mb-4 text-sm text-gray-600">
        {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
    </div>

   

    <form method="POST" action="{{ route('password.confirm') }}" class='border border-1 p-5 rounded mx-2'>
        @csrf

        <!-- Password -->
        <div>
            <x-label for="password" :value="__('Password')" />

            <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
        </div>

        <div class="flex justify-end mt-4">
            <x-button class='btn btn-primary'>
                {{ __('Confirm') }}
            </x-button>
        </div>
    </form>
</div>
@endsection