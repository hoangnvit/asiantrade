@extends('layouts.admin')

@section('title', 'Users managed page')



@section('content')

<div class='d-flex d-flex justify-content-center rounded'>
    <!-- Session Status -->
    <!-- <x-auth-session-status class="mb-4" :status="session('status')" /> -->

    <!-- Validation Errors -->
    
    <x-auth-validation-errors class="mb-2" :errors="$errors" />
    


</div>
<div class='d-flex d-flex justify-content-center  p-2'>



    <form method="POST" action="{{ route('user_store') }}" class='border border-1 p-5 rounded mx-2'>
        @csrf

        <!-- Username -->
        <div class='row'>
            <x-label class='col-5' for="username" :value="__('Username')" />

            <x-input id="username" class="block mt-1 w-full col-7" type="text" name="username" :value="old('username')" required autofocus />
        </div>

        <!-- Email Address -->
        <div class="mt-2 row">
            <x-label for="email" :value="__('Email')" class='col-5' />

            <x-input id="email" class="block mt-1 w-full col-7" type="email" name="email" :value="old('email')" required />
        </div>

        <!-- Password -->
        <div class="mt-2 row">
            <x-label for="password" :value="__('Password')" class='col-5' />

            <x-input id="password" class="block mt-1 w-full col-7" type="password" name="password" required autocomplete="new-password" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-2 row">
            <x-label for="password_confirmation" :value="__('Confirm Password')" class='col-5' />

            <x-input id="password_confirmation" class="block mt-1 w-full col-7" type="password" name="password_confirmation" required />
        </div>

        <!-- firstname -->
        <div class='row mt-2'>
            <x-label for="fname" :value="__('Firstname')" class='col-5' />

            <x-input id="fname" class="block mt-1 w-full 7" type="text" name="fname" :value="old('fname')" required autofocus />
        </div>

        <!-- lname -->
        <div class='row mt-2'>
            <x-label for="lname" :value="__('Lastname')" class='col-5' />

            <x-input id="lname" class="block mt-1 w-full 7" type="text" name="lname" :value="old('lname')" required autofocus />
        </div>

        <!-- Address -->
        <div class='row mt-2'>
            <x-label for="address" :value="__('Address')" class='col-5' />

            <x-input id="address" class="block mt-1 w-full col-7" type="text" name="address" :value="old('address')" required autofocus />
        </div>

        <!-- Username -->
        <div class='row mt-2'>
            <x-label for="postalcode" :value="__('Postalcode')" class='col-5' />

            <x-input id="postalcode" class="block mt-1 w-full col-7" type="text" name="postalcode" :value="old('postalcode')" required autofocus />
        </div>

        <div class='row mt-2'>
            <label for="admin" class='col-5'> Admin Role</label>
            <div class='col-7'>
                <input id="admin" class="block mt-1 w-full" type="radio" name="admin" value=1 />
                <label for="admin"> Admin</label>
                <input id="admin" class="block mt-1 w-full" type="radio" name="admin" value=0 checked />
                <label for="admin"> Users</label>
            </div>
        </div>

        <div class="flex items-center justify-end mt-2">


            <x-button class="ml-4 btn btn-primary">
                {{ __('Create new User') }}
            </x-button>
        </div>
    </form>
</div>

@endsection