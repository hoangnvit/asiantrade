@extends('layouts.master')

@section('title', 'Password Page')



@section('content')


<div class='d-flex d-flex justify-content-center rounded'>
    <!-- Session Status -->
    <!-- <x-auth-session-status class="mb-4" :status="session('status')" /> -->

    <!-- Validation Errors -->
    
    <x-auth-validation-errors class="mb-4" :errors="$errors" />
    


</div>
<div class='d-flex d-flex justify-content-center  p-2'>


  
   

    <form method="POST" action="{{ route('changepassword') }}" class='border border-1 p-5 rounded mx-2'>
        @csrf



        <!-- Email Address -->
        <div class="row">
            <x-label class='col-6' for="oldpassword" :value="__('Current Password')" />

            <x-input id="oldpassword" class="block mt-1 w-full col-6" type="password" name="oldpassword" required autofocus />
        </div>

        <!-- Password -->
        <div class="mt-4 row">
            <x-label class='col-6' for="password" :value="__('Password')" />

            <x-input id="password" class="block mt-1 w-full col-6" type="password" name="password" required />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4 row">
            <x-label class='col-6' for="password_confirmation" :value="__('Confirm Password')" />

            <x-input id="password_confirmation" class="block mt-1 w-full col-6" type="password" name="password_confirmation" required />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="btn btn-primary" href="{{ route('home') }}">
                {{ __('Cancel') }}
            </a>


            <button class="btn btn-primary ml-4">
                {{ __('Change Password') }}
            </button>
            <!-- <x-button>
                    {{ __('Change Password') }}
                </x-button> -->
        </div>

        @if(@isset($stt)) <h1>{{$stt}}</h1>
        @endif
    </form>

</div>

@endsection