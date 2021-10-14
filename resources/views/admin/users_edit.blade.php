@extends('layouts.admin')

@section('title', 'Users managed page')



@section('content')


<div class=' d-flex justify-content-center border border-2 rounded border-warning p-2'>

    <!-- Validation Errors -->
    <x-auth-validation-errors class="mb-4" :errors="$errors" />

    <form method="POST" action="{{route('user_edit',$user_detail['id']) }}" enctype="multipart/form-data" class='border border-1 p-5 rounded mx-2'>
        @csrf
        <div>
            <div class="col-7">


                <input id="id" class="block mt-1 w-full" type="hidden" name="id" value="{{ $user_detail['id'] ?? '' }}" />

            </div>
            <div class='row'>
                <label class='col-4'> Username:</label>
                <label class='col-8'> {{ $user_detail['username'] ?? '' }}</label>

                <!-- <input id="username" class="block mt-1 w-full" type="text" name="username" value="{{ $user_detail['username'] ?? '' }}" readonly /> -->
            </div>

            <!-- Email Address -->
            <div class="mt-2 row">
                <label class='col-4'>Email: </label>
                <label class='col-8'>{{ $user_detail['email'] ?? ''}}</label>

                <!-- <input id="email" class="block mt-1 w-full border" type="email" name="email" value="{{ $user_detail['email'] ?? ''}}" readonly /> -->
            </div>

            <!-- firstname -->
            <div class='row mt-2'>
                <label for="fname" class='col-4'> Firstname</label>

                <input id="fname" class="block mt-1 w-full col-8" type="text" name="fname" value="{{ $user_detail['fname'] ?? ''}}" required autofocus />
            </div>

            <!-- lname -->
            <div class='row mt-2'>
                <label for="lname" class='col-4'> Lastname</label>

                <x-input id="lname" class="block mt-1 w-full col-8" type="text" name="lname" value="{{ $user_detail['lname'] ?? ''}}" required autofocus />
            </div>

            <!-- Address -->
            <div class='row mt-2'>
                <label for="address" class='col-4'> Address</label>

                <input id="address" class="block mt-1 w-full col-8" type="text" name="address" value="{{ $user_detail['address'] ?? ''}}" required autofocus />
            </div>

            <!-- Postal code -->
            <div class='row mt-2'>
                <label for="postalcode" :value="__('Postalcode')" class='col-4'> Postal Code</label>

                <input id="postalcode" class="block mt-1 w-full col-8" type="text" name="postalcode" value="{{ $user_detail['postalcode'] ?? ''}}" required autofocus />
            </div>

            <div class='row mt-2'>
                <div class='col-4'>
                    <label for="admin" :value="__('Postalcode')"> Role</label>
                </div>
                @if( $user_detail['admin'] == 1 )
                    <div class='col-4'>

                        <input id="admin" class="block mt-1 w-full" type="radio" name="admin" value=1 checked/>
                        <label for="admin"> Admin</label>
                    </div>
                    <div class='col-4'>
                        <input id="admin" class="block mt-1 w-full" type="radio" name="admin" value=0  />
                        <label for="admin"> Users</label>
                    </div>

                @else
                <div class='col-4'>

                    <input id="admin" class="block mt-1 w-full" type="radio" name="admin" value=1/>
                    <label for="admin"> Admin</label>
                    </div>
                    <div class='col-4'>
                    <input id="admin" class="block mt-1 w-full" type="radio" name="admin" value=0   checked />
                    <label for="admin"> Users</label>
                    </div>



                @endif
            </div>

        </div>

        <div class="col-4">

            <img class='user_avatar' src="{{asset('uploads/images/'. $user_detail['avatar'])}}" alt=" image default">
        </div>
        <div>
            <input type="file" name="image" class="form-control mt-2">
        </div>
        <div class="flex items-center justify-end mt-4">


            <button class="ml-4 btn btn-primary">
                {{ __('Update') }}
            </button>


        </div>

    </form>


</div>


@endsection