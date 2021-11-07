
@extends('layouts.master')

@section('title', 'Reset Password page')



@section('content')

<div class='d-flex d-flex justify-content-center rounded'>
    <!-- Session Status -->
    <!-- <x-auth-session-status class="mb-4" :status="session('status')" /> -->

    <!-- Validation Errors -->
    
    <x-auth-validation-errors class="mb-2" :errors="$errors" />
    


</div>

<div class='d-flex d-flex justify-content-center p-2'>
      

       

        <form method="POST" action="{{ route('password.update') }}" class='border border-1 p-5 rounded mx-2'>
            @csrf

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Email Address -->
            <div class='row'>
                <x-label for="email" :value="__('Email')" class='col-5' />

                <x-input id="email" class="block mt-1 w-full col-7" type="email" name="email" :value="old('email', $request->email)" required autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4 row">
                <x-label for="password" :value="__('Password')" class='col-5' />

                <x-input id="password" class="block mt-1 w-full col-7" type="password" name="password" required />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4 row">
                <x-label for="password_confirmation" :value="__('Confirm Password')"  class='col-5'/>

                <x-input id="password_confirmation" class="block mt-1 w-full col-7"
                                    type="password"
                                    name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button class='btn btn-primary'>
                    {{ __('Reset Password') }}
                </x-button>
            </div>
        </form>
</div>
@endsection