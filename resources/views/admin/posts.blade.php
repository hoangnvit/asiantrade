@extends('layouts.admin')

@section('title', 'Users managed page')



@section('content')

<h3><a href="{{route('post_add')}}"> Add Post</a></h3>

<x-auth-validation-errors class="mb-4" :errors="$errors" />
<table class='table-responsive bg-light'>

    <tr class="border border-2">

        <th class="col-1">
            ID&nbsp;  <a href="{{route('admin_posts',0)}}">&#8593;</a>&nbsp;<a href="{{route('admin_posts',1)}}">&#8595;</a>
        </th>
        <th class="col-1">
            Title&nbsp;  <a href="{{route('admin_posts',2)}}">&#8593;</a>&nbsp;<a href="{{route('admin_posts',3)}}">&#8595;</a>
        </th>

        <th class="col-1">
            Category

        </th>


        <th class="col-1">
            avatar
        </th>
        <th class="col-1">
            Price
        </th>
        <th class="col-1">
            Status
        </th>


        <th class="col-1">
            Action
        </th>

    </tr>
    @foreach($posts as $post)
    <tr class="border border-2">


        <td class="col-1">
            {{$post['id']}}
        </td>
        <td class="col-1">
            {{$post['title']}}
        </td>


        <td class="col-1">
            <!-- {{$post['description']}} -->
            {{$post->category->name}}
        </td>

        <td class="col-1">
            <img class="cat_avatar_table" src="{{$post['avatar']}}" alt="">
        </td>
        <td class="col-1">
            {{$post['price']}}
        </td>
        <td class="col-1">

            @if($post['status']==1) Active
            @else No-Active
            @endif
        </td>

        <td class="col-1">
            <a class="button btn-primary border rounded mx-1 my-1 p-1" href="{{route('post_edit',$post['id'])}}">EDIT</a>
          
            <a class="button btn-primary border rounded mx-1 my-1 p-1" href="{{route('admin_posts_delete_form',['post_id'=>$post['id']])}}">DELETE</a>    



        </td>

    </tr>
    @endforeach

</table>

@endsection


@section('script')

<script src="{{asset('js/delete.js') }}"> </script>

@endsection