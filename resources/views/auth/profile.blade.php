@extends('layouts.master')

@section('title', 'Profile page')



@section('content')


<div class='d-flex d-flex justify-content-center border border-2 rounded border-warning p-2'>

    <!-- Validation Errors -->
    <x-auth-validation-errors class="mb-4" :errors="$errors" />

    <form method="POST" action="{{ route('updateprofile') }}" enctype="multipart/form-data" class='border border-1 p-5 rounded mx-2'>

        @csrf

        <div class="w-50 mx-auto ">

            @if(@empty($user['avatar']))
            <img class='user_avatar' src="{{asset('images/avatar_default.png')}}" alt="default avatar">
            @else
            <img class='user_avatar' src="{{$user['avatar']}}" alt=" image default">
            @endif



            <div>
                <input type="file" name="image" class="form-control">
            </div>

            <h5 class="text-center my-3 text-primary text-capitalize">{{$user['username']}}</h5>

            <a href="{{route('changepassword_form')}}"> Change the password</a>
        </div>

        <!-- Email Address -->
        <div class="mt-4 row">
            <x-label for="email" :value="__('Email')" class='col-5' />

            <x-input id="email" class="block mt-1 w-full col-7" type="email" name="email" value="{{$user['email']}}" Readonly />
        </div>



        <!-- firstname -->
        <div class='row'>
            <x-label for="fname" :value="__('Firstname')" class='col-5' />

            <x-input id="fname" class="block mt-1 w-full col-7" type="text" name="fname" value="{{$user['fname']}}" required />
        </div>

        <!-- lname -->
        <div class='row'>
            <x-label for="lname" :value="__('Lastname')" class='col-5' />

            <x-input id="lname" class="block mt-1 w-full col-7" type="text" name="lname" value="{{$user['lname']}}" required />
        </div>

        <!-- Address -->
        <div class='row'>
            <x-label for="address" :value="__('Address')" class='col-5' />

            <x-input id="address" class="block mt-1 w- col-7" type="text" name="address" :value="$user['address']" required />
        </div>

        <!-- postalcode -->
        <div class='row'>
            <x-label for="postalcode" :value="__('Postalcode')" class='col-5' />

            <x-input id="postalcode" class="block mt-1 w-full col-7" type="text" name="postalcode" :value="$user['postalcode']" required />
        </div>

        <!-- joined date -->
        <div>
            <x-label for="joindate" :value="__('Join Date:')" /> {{$user['created_at']}}


        </div>
        <!-- joined date -->
        <!-- <div>
                <x-label for="type" :value="__('Type')" /> {{$user['type_id']}}
                
            </div> -->


        <div class="flex items-center justify-end mt-4">
            <a class="btn btn-primary" href="{{ route('home') }}">
                {{ __('Back') }}
            </a>


            <button class="btn btn-primary ml-4">
                {{ __('Update') }}
            </button>

        </div>
    </form>


</div>






@endsection