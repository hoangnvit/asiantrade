@extends('layouts.admin')

@section('title', 'Users managed page')



@section('content')

<h1><a href="users/add"> Add user</a></h1>

<x-auth-validation-errors class="mb-4" :errors="$errors" />
<table class='table-responsive'>

    <tr class='border border-2'>

        <th class="col-1">
            ID
        </th>
        <th class="col-1">
            Username
        </th>
        <th class="col-1">
            Fullname

        </th>
        <th class="col-1">
            Email
        </th>
        <!-- <th class="col-1">
                    Address
                </th> -->
        <th class="col-1">
                   Avatar
                </th>
        <!-- <th class="col-1">
            Postalcode
        </th> -->
        <th class="col-1">
            Admin
        </th>
        <!-- <th class="col-1">
                    Created at
                </th> -->
        <th class="col-1">
            Action
        </th>

    </tr>
    @foreach($users as $user)
    <tr class='border border-2'>


        <td class="col-1">
            @if($user['username']!= Auth::user()->username)
            <a href="{{route('detail',$user['id'])}}">{{$user['id']}}</a>
            @else {{$user['id']}}
            @endif
        </td>
        <td class="col-1 text-capitalize">
            {{$user['username']}}
        </td>
        <td class="col-1">
            {{$user['fname']}} {{$user['lname']}}
        </td>
        <td class="col-1">
            {{$user['email']}}
        </td>
        <!-- <td>
                    {{$user['address']}}
                </td> -->
        <td class="col-1">
                    <!-- {{$user['avatar']}} -->
                    <img class="cat_avatar_table" src="{{$user['avatar']}}" alt="">
                </td>
        <!-- <td class="col-1">
            {{$user['postalcode']}}
        </td> -->
        <td class="col-1">

            @if($user['admin']==1) Admin
            @else No
            @endif
        </td>
        <!-- <td class="col-1">
                    {{$user['created_at']}}
                </td> -->
        <td class="col-1">
            @if($user['username']!= Auth::user()->username)


            <a class="button btn-primary border rounded" href="{{route('user_edit',$user['id'])}}">EDIT</a>
            <a id="btn_delete" class="button btn-primary rounded" onclick="return confirm('Are you sure?')" href="{{route('user_delete',$user['id'])}}">DELETE <i class="fa fa-trash"></i></a>
            @endif
        </td>

    </tr>
    @endforeach

</table>


@endsection


@section('script')

<script src="{{asset('js/delete.js') }}"> </script>

@endsection